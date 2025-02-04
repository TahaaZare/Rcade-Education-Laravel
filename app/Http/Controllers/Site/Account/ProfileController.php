<?php

namespace App\Http\Controllers\Site\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\Blog\StoreBlogRequest;
use App\Http\Requests\Auth\ConfirmUserNameLogin;
use App\Http\Requests\Site\Account\Blog\StoreUserBlogRequest;
use App\Http\Requests\Site\Account\Blog\UpdateUserBlogRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Account\User;
use App\Models\Account\UserPoint;
use App\Models\Account\UserPointLog;
use App\Models\Content\Blog\Blog;
use App\Models\Content\Blog\BlogCategory;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function FollowUser($following, $follower)
    {
        $user_1 = User::where('username', $following)->first();
        $user_2 = User::where('username', $follower)->first();

        $user_1->follow($user_2);
        return back()->with('swal-success', 'دنبال کردن با موفقیت انجام شـد');
    }
    public function UnFollowUser($following, $follower)
    {
        $user_1 = User::where('username', $following)->first();
        $user_2 = User::where('username', $follower)->first();

        $user_1->unfollow($user_2);
        return back()->with('swal-success', 'لغو دنبال کردن با موفقیت انجام شـد');
    }
    public function SelectUsername(User $user)
    {
        $auth_user = auth()->user();
        if ($user->mobile == $auth_user->mobile) {
            if ($auth_user->username != null) {
                return redirect()->route('user.profile', $user->username);
            } else {
                return view('site.account.select-username', compact('user'));
            }
        } else {
            Auth::logout();
            abort(404);
        }
    }
    public function ConfirmUsername(ConfirmUserNameLogin $request, User $user)
    {
        $auth_user = auth()->user();

        // Remove spaces from the username
        $username = str_replace(' ', '', $request->username);

        if ($user->mobile == $auth_user->mobile) {
            $auth_user = auth()->user();
            if ($auth_user->username != null) {
                return redirect()->route('user.profile', $user->username);
            } else {
                $user->update([
                    'username' => $username
                ]);
                return redirect()->route('user.profile', $username)
                    ->with('swal-success', 'خوش آمدید :)');
            }
        } else {
            Auth::logout();
            abort(404);
        }
    }

    public function UserProfile(User $user)
    {
        $auth_user = auth()->user();
        $user_blogs = Blog::where('status', 1)->where('user_id', $user->id)->where('create_by', $user->id)->get();

        return view('site.account.user-profile', compact('user', 'user_blogs'));
    }


    public function MyProfile(User $user)
    {
        $auth_user = auth()->user();
        if ($auth_user != null) {
            if ($user->username != null) {
                if ($auth_user->username == $user->username) {
                    if ($user != null) {
                        if ($user->status == 1) {
                            if ($user->ban == 0) {
                                $user_blogs = Blog::where('user_id', $user->id)->where('create_by', $user->id)->get();
                                return view('site.account.profile', compact('user', 'user_blogs'));
                            } else {
                                Auth::logout();
                                return redirect()->route('home')
                                    ->with('swal-warning', 'حساب شما مسدود شده است !');
                            }
                        } else {
                            Auth::logout();
                            return redirect()->route('home')
                                ->with('swal-warning', 'حساب شما غیر فعال میباشد !');
                        }
                    } else {
                        return redirect()->route('home');
                    }
                } else {
                    Auth::logout();
                    abort(404);
                }
            } else {
                return redirect()->route('select-username', $user)
                    ->with('swal-success', 'ثبت نام شما با موفقیت انجام شد , لطفا نام کاربری خود را وارد کنید');
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function UpdateUserInfo(Request $request, User $user)
    {
        $auth_user = auth()->user();
        if ($auth_user != null) {
            if ($user->username != null) {
                if ($auth_user->username == $user->username) {
                    if ($user != null) {
                        if ($user->status == 1) {
                            if ($user->ban == 0) {
                                $user->update([
                                    'display_name' => $request->display_name
                                ]);
                                return back()->with('swal-success', 'عملیات با موفقیت انجام شد.');
                            } else {
                                Auth::logout();
                                return redirect()->route('home')
                                    ->with('swal-warning', 'حساب شما مسدود شده است !');
                            }
                        } else {
                            Auth::logout();
                            return redirect()->route('home')
                                ->with('swal-warning', 'حساب شما غیر فعال میباشد !');
                        }
                    } else {
                        return redirect()->route('home');
                    }
                } else {
                    Auth::logout();
                    abort(404);
                }
            } else {
                return redirect()->route('select-username', $user)
                    ->with('swal-success', 'ثبت نام شما با موفقیت انجام شد , لطفا نام کاربری خود را وارد کنید');
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function UpdateBio(Request $request, User $user)
    {
        $auth_user = auth()->user();
        if ($auth_user != null) {
            if ($user->username != null) {
                if ($auth_user->username == $user->username) {
                    if ($user != null) {
                        if ($user->status == 1) {
                            if ($user->ban == 0) {
                                $user->update([
                                    'bio' => $request->bio
                                ]);
                                return back()->with('swal-success', 'عملیات با موفقیت انجام شد.');
                            } else {
                                Auth::logout();
                                return redirect()->route('home')
                                    ->with('swal-warning', 'حساب شما مسدود شده است !');
                            }
                        } else {
                            Auth::logout();
                            return redirect()->route('home')
                                ->with('swal-warning', 'حساب شما غیر فعال میباشد !');
                        }
                    } else {
                        return redirect()->route('home');
                    }
                } else {
                    Auth::logout();
                    abort(404);
                }
            } else {
                return redirect()->route('select-username', $user)
                    ->with('swal-success', 'ثبت نام شما با موفقیت انجام شد , لطفا نام کاربری خود را وارد کنید');
            }
        } else {
            return redirect()->route('home');
        }
    }

    #region blog


    public function CreateBlog(User $user)
    {
        $auth_user = auth()->user();
        if ($auth_user != null) {
            if ($auth_user->username == $user->username) {
                if ($user != null) {
                    if ($user->status == 1) {
                        if ($user->ban == 0) {
                            $categories = BlogCategory::all();
                            return view('site.account.blog.create', compact('user', 'categories'));
                        } else {
                            Auth::logout();
                            return redirect()->route('home')
                                ->with('swal-warning', 'حساب شما مسدود شده است !');
                        }
                    } else {
                        Auth::logout();
                        return redirect()->route('home')
                            ->with('swal-warning', 'حساب شما غیر فعال میباشد !');
                    }
                } else {
                    return redirect()->route('home');
                }
            } else {
                Auth::logout();
                abort(404);
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function StoreBlog(StoreUserBlogRequest $request, ImageService $imageService, User $user)
    {
        $auth_user = auth()->user();
        if ($auth_user != null) {
            if ($auth_user->username == $user->username) {
                if ($user != null) {
                    if ($user->status == 1) {
                        if ($user->ban == 0) {
                            DB::beginTransaction();

                            try {

                                $inputs = $request->all();
                                if ($request->hasFile('image')) {
                                    $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'blogs');
                                    $result = $imageService->save_Webp($request->file('image'));
                                    if ($result === false) {
                                        return back()->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
                                    }
                                    $inputs['image'] = $result;
                                }

                                $inputs['user_id'] = $user->id;
                                $inputs['create_by'] = $user->id;
                                $inputs['status'] = 0;
                                $inputs['meta_description'] = "meta_description";



                                $blog = Blog::create($inputs);

                                $find_user_points = UserPoint::find($user->id);
                                if ($find_user_points != null) {
                                    $find_user_points->update([
                                        'point' => $find_user_points->point + 30
                                    ]);
                                } else {
                                    $user_point = UserPoint::create([
                                        'user_id' => $user->id,
                                        'point' => 30
                                    ]);

                                    UserPointLog::create([
                                        'user_id' => $user->id,
                                        'point_id' => $user_point->id,
                                        'log' => 'BLOG'
                                    ]);
                                }


                                $hashids = new Hashids('your_salt_here', 6); // 'your_salt_here' should be replaced with your preferred salt and 6 is the length of the short link
                                $short_link = $hashids->encode($blog->id);

                                // Update the product with the short link
                                $blog->update(['slug' => $short_link]);

                                DB::commit();


                                return redirect()->route('user.profile', $user->username)
                                    ->with('swal-success', 'عملیات با موفقیت انجام شد .');
                            } catch (\Exception $e) {
                                DB::rollback();

                                return "Transaction failed. Error: " . $e->getMessage();
                            }
                        } else {
                            Auth::logout();
                            return redirect()->route('user.profile', $user->username)
                                ->with('swal-warning', 'حساب شما مسدود شده است !');
                        }
                    } else {
                        Auth::logout();
                        return redirect()->route('home')
                            ->with('swal-warning', 'حساب شما غیر فعال میباشد !');
                    }
                } else {
                    return redirect()->route('home');
                }
            } else {
                Auth::logout();
                abort(404);
            }
        } else {
            return redirect()->route('home');
        }
    }


    public function EditBlog(User $user, Blog $blog)
    {
        $auth_user = auth()->user();
        if ($auth_user != null) {
            if ($auth_user->username == $user->username) {
                if ($user != null) {
                    if ($user->status == 1) {
                        if ($user->ban == 0) {
                            $categories = BlogCategory::all();
                            return view('site.account.blog.edit', compact('user', 'categories', 'blog'));
                        } else {
                            Auth::logout();
                            return redirect()->route('home')
                                ->with('swal-warning', 'حساب شما مسدود شده است !');
                        }
                    } else {
                        Auth::logout();
                        return redirect()->route('home')
                            ->with('swal-warning', 'حساب شما غیر فعال میباشد !');
                    }
                } else {
                    return redirect()->route('home');
                }
            } else {
                Auth::logout();
                abort(404);
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function UpdateBlog(UpdateUserBlogRequest $request, ImageService $imageService, User $user, Blog $blog)
    {
        $auth_user = auth()->user();
        if ($auth_user != null) {
            if ($auth_user->username == $user->username) {
                if ($user != null) {
                    if ($user->status == 1) {
                        if ($user->ban == 0) {
                            DB::beginTransaction();

                            try {

                                $inputs = $request->all();
                                if ($request->hasFile('image')) {
                                    $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'blogs');
                                    $result = $imageService->save($request->file('image'));
                                    if ($result === false) {
                                        return back()->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
                                    }
                                    $inputs['image'] = $result;
                                }

                                $inputs['meta_description'] = "meta_description";


                                $inputs['status'] = 0;

                                $blog->update($inputs);


                                DB::commit();


                                return redirect()->route('user.profile', $user->username)
                                    ->with('swal-success', 'عملیات با موفقیت انجام شد .');
                            } catch (\Exception $e) {
                                DB::rollback();

                                return "Transaction failed. Error: " . $e->getMessage();
                            }
                        } else {
                            Auth::logout();
                            return redirect()->route('user.profile', $user->username)
                                ->with('swal-warning', 'حساب شما مسدود شده است !');
                        }
                    } else {
                        Auth::logout();
                        return redirect()->route('home')
                            ->with('swal-warning', 'حساب شما غیر فعال میباشد !');
                    }
                } else {
                    return redirect()->route('home');
                }
            } else {
                Auth::logout();
                abort(404);
            }
        } else {
            return redirect()->route('home');
        }
    }



    #endregion

}

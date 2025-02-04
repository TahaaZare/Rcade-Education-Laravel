<?php

namespace App\Http\Controllers\Admin\Content\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\Course\Episode\StoreEpisodeAdminRequest;
use App\Http\Requests\Admin\Content\Course\Episode\UpdateEpisodeAdminRequest;
use App\Http\Services\File\FileService;
use App\Models\Account\User;
use App\Models\Content\Course\Course;
use App\Models\Content\Course\CourseEpisode;
use App\Models\Content\Course\CourseSesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseEpisodeController extends Controller
{
    public function index(User $user, Course $course, CourseSesson $sesson)
    {
        $auth_user = auth()->user();
        if ($auth_user != null) {
            if ($auth_user->username == $user->username) {
                if ($user != null) {
                    if ($user->user_type == 2) {
                        $episodes = CourseEpisode::where('sesson_id', $sesson->id)->where('course_id', $course->id)->get();
                        return view(
                            'admin.content.course.episode.index',
                            compact('user', 'course', 'sesson', 'episodes')
                        );
                    } else {
                        Auth::logout();
                        abort(404);
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
    public function create(User $user, Course $course, CourseSesson $sesson)
    {
        $auth_user = auth()->user();
        if ($auth_user != null) {
            if ($auth_user->username == $user->username) {
                if ($user != null) {
                    if ($user->user_type == 2) {
                        return view('admin.content.course.episode.create', compact('user', 'course', 'sesson'));
                    } else {
                        Auth::logout();
                        abort(404);
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
    public function store(StoreEpisodeAdminRequest $request, FileService $fileService, User $user, Course $course, CourseSesson $sesson)
    {
        $auth_user = auth()->user();
        if ($auth_user != null) {
            if ($auth_user->username == $user->username) {
                if ($user != null) {
                    if ($user->user_type == 2) {
                        DB::beginTransaction();

                        try {

                            $inputs = $request->all();
                            if ($request->hasFile('file')) {
                                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'course-episodes');
                                $fileService->setFileSize($request->file('file'));
                                $fileSize = $fileService->getFileSize();
                                $result = $fileService->moveToPublic($request->file('file'));
                                $fileFormat = $fileService->getFileFormat();
                                $inputs['course_id'] = $course->id;
                                $inputs['sesson_id'] = $sesson->id;
                                $inputs['file_path'] = $result;
                                $inputs['file_size'] = $fileSize;
                                $inputs['file_type'] = $fileFormat;
                                $episode = CourseEpisode::create($inputs);
                            }

                            DB::commit();


                            return redirect()->route('admin.course-episode.index', [$user->username, $course, $sesson])
                                ->with('swal-success', 'عملیات با موفقیت انجام شد .');
                        } catch (\Exception $e) {
                            DB::rollback();

                            return "Transaction failed. Error: " . $e->getMessage();
                        }
                    } else {
                        Auth::logout();
                        abort(404);
                    }
                } else {
                    return redirect()->route('home');
                }
            } else {
                Auth::logout();
                abort(404);
            }
        } else {
            return redirect()->routel('home');
        }
    }
    public function edit(User $user, Course $course, CourseSesson $sesson, CourseEpisode $episode)
    {
        $auth_user = auth()->user();
        if ($auth_user != null) {
            if ($auth_user->username == $user->username) {
                if ($user != null) {
                    if ($user->user_type == 2) {
                        return view(
                            'admin.content.course.episode.edit',
                            compact('user', 'course', 'sesson', 'episode')
                        );
                    } else {
                        Auth::logout();
                        abort(404);
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
    public function update(UpdateEpisodeAdminRequest $request, FileService $fileService,  User $user, Course $course, CourseSesson $sesson, CourseEpisode $episode)
    {

        $auth_user = auth()->user();
        if ($auth_user != null) {
            if ($auth_user->username == $user->username) {
                if ($user != null) {
                    if ($user->user_type == 2) {


                        DB::beginTransaction();

                        try {

                            $inputs = $request->all();
                            if ($request->hasFile('file')) {
                                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'course-episodes');
                                $fileService->setFileSize($request->file('file'));
                                $fileSize = $fileService->getFileSize();
                                $result = $fileService->moveToPublic($request->file('file'));
                                $fileFormat = $fileService->getFileFormat();
                                $inputs['file_path'] = $result;
                                $inputs['file_size'] = $fileSize;
                                $inputs['file_type'] = $fileFormat;
                            }
                            $inputs['name'] = $request->name;
                            $inputs['description'] = $request->description;
                            $inputs['status'] = $request->status;
                            $e = $episode->update($inputs);

                            DB::commit();

                            return redirect()->route('admin.course-episode.index', [$user->username, $course, $sesson])
                                ->with('swal-success', 'عملیات با موفقیت انجام شد .');
                        } catch (\Exception $e) {
                            DB::rollback();

                            return "Transaction failed. Error: " . $e->getMessage();
                        }
                    } else {
                        Auth::logout();
                        abort(404);
                    }
                } else {
                    return redirect()->route('home');
                }
            } else {
                Auth::logout();
                abort(404);
            }
        } else {
            return redirect()->routel('home');
        }
    }
}

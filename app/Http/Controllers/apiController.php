<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\album_photos;
use App\albums;
use App\blog;
use App\candidates;
use App\changeLog;
use App\commentIssue;
use App\company_details;
use App\Events\newMessage;
use App\FileDocument;
use App\goodsItemTransfer;
use App\goodsReceip;
use App\goodsTransfer;
use App\id_agamas;
use App\issue;
use App\id_domisilis;
use App\inventoryItem;
use App\itemGroup;
use App\jobvacancy;
use App\Mail\AddComment;
use App\Mail\addCommentToCreator;
use App\Mail\addUser;
use App\Mail\closedIssue;
use App\Mail\confirmUpdateIssue;
use App\Mail\confirmUpdateProfile;
use App\Mail\GoodsReceive;
use App\Mail\makeNewIssue;
use App\messages;
use App\notepad;
use App\quotes;
use App\stockGroup;
use App\track_orders;
use App\track_reports;
use App\userdetails;
use App\userGuide;
use App\warehouseList;
use Illuminate\Support\Facades\Date;
use App\popupWindow;
use App\userLogs;
use App\warehouseCustomer;
use App\itemHistory;
use App\itemsPurchase;
use App\documentsDelivery;
use App\itemOndocumentsDelivery;
use App\Mail\newDocumentDelivery;
use App\itemsSales;
use Mail;

class apiController extends Controller
{
    public function getLoggedUser()
    {
        return User::find(Auth::id());
    }
    public function getUsers()
    {
        return response()->json(User::orderBy('name', 'asc')->get());
    }
    public function deleteUser($id)
    {
        $getUser = User::find($id);
        $getUser->status = '2';
        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Delete user ' . $getUser->username . ' from user management.';
        $saveLogs->save();
        $getUser->save();

        return response()->json([], 204);
    }
    public function checkUsersData(Request $req)
    {
        $data = $req->all();
        $userId = isset($data['id']) ? $data['id'] : null;
        $sameEmailUser = User::where(['email' => $data['email']])->first();
        $sameNameUser = User::where(['name' => $data['name']])->first();
        $sameOldPasswordUser = User::where(['unpassword' => $data['oldPassword']])->first();

        return response()->json([
            'existingEmail' => isset($sameEmailUser) && $sameEmailUser->id != $userId,
            'existingName' => isset($sameNameUser) && $sameNameUser->id != $userId,
            'existingPassword' => isset($sameOldPasswordUser) && $sameOldPasswordUser->id != $userId,
        ]);
    }
    public function checkUserData(Request $req)
    {
        $data = $req->all();
        $userId = isset($data['id']) ? $data['id'] : null;
        $sameEmailUser = User::where(['email' => $data['email']])->first();
        $sameNameUser = User::where(['name' => $data['name']])->first();

        return response()->json([
            'existingEmail' => isset($sameEmailUser) && $sameEmailUser->id != $userId,
            'existingName' => isset($sameNameUser) && $sameNameUser->id != $userId,
        ]);
    }
    public function getUsernameData($username)
    {
        return response()->json(User::where('username', $username)->get());
    }
    public function addUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = strtolower($request->name);
        $user->role = $request->role;
        $user->department = $request->department;
        $user->status = '1';
        $user->divisi = $request->divisi;
        $user->gender = $request->gender;
        $user->organisation = 'BTSA LOGISTICS';
        $user->phone = '000';
        if ($user->gender == 'M') {
            $arr = array(1, 3, 5);
            shuffle($arr);
            $randVal = $arr[0];
            $user->avatar = $randVal . '.jpg';
            $user->cover = $randVal . '.jpg';
        } else {
            $arr = array(2, 4, 6);
            shuffle($arr);
            $randVal = $arr[0];
            $user->avatar = $randVal . '.jpg';
            $user->cover = $randVal . '.jpg';
        }
        $user->password = Hash::make($request->password);
        $user->unpassword = $request->password;
        $user->createdBy = Auth::id();
        $user->logip = $request->ip();
        $user->lastLogin = '0';

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add user ' . $user->username . ' to system.';
        $saveLogs->save();

        $user->save();
        Mail::to($user->email)->send(new addUser($user));
        return response()->json($user, 201);
    }
    public function countUsers()
    {
        $userCount = DB::table('users')
            ->get()
            ->count();
        return response()->json($userCount);
    }
    public function getUserbyId($id)
    {
        return response()->json(User::find($id));
    }
    public function getContactList()
    {
        return response()->json(User::where('divisi', '!=', 'developer')->where('role', '!=', 'customer')->where('role', '!=', 'supplier')->orderBy('name', 'asc')->get());
    }
    public function updateUser($id, Request $request)
    {
        $user = User::find($id);
        foreach (['name', 'role', 'department', 'divisi', 'gender', 'email', 'status'] as $field) {
            if (isset($request->{$field})) {
                $user->{$field} = $request->{$field};
            }
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->unpassword = $request->password;
        }

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Edit/update user ' . $user->username . ' from user management.';
        $saveLogs->save();

        $user->save();
        Mail::to($user->email)->send(new confirmUpdateIssue($user));
        return response()->json($user);
    }
    //
    // ISSUE API
    public function addNewIssue(Request $request)
    {
        $issue = new issue();
        $issue->title = $request->title;
        $issue->issue = $request->description;
        $issue->assignee = $request->assignee;
        $issue->priority = $request->priority;
        if (auth()->user()->role == 'head') {
            $issue->approved_by = Auth::id();
            $issue->status = '1';
        } else {
            $issue->approved_by = 0;
            $issue->status = '0';
        }
        $issue->created_by = auth()->user()->id;

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Request new issue ' . $issue->title . '.';
        $saveLogs->save();

        $issue->save();
        if ($issue->status = '1') {
            $issues = issue::with('user')->with('assigne')->get()->find($issue->id);
            Mail::to($issues->assigne->email)->send(new makeNewIssue($issues));
        }
        return response()->json($issue, 201);
    }
    public function getIssues()
    {
        $role = $this->getLoggedUser()->role;
        if ($role == 'user' || $role == 'it') {
            return issue::with('user')
                ->withCount('comments')
                ->where('assignee', Auth::id())
                ->where('status', '!=', '2')
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            return issue::with('user')->with('comments')
                ->where('status', '=', '0')
                ->orderBy('created_at', 'DESC')
                ->get();
        }
    }
    public function getIssuesCount()
    {
        $role = $this->getLoggedUser()->role;
        if ($role == 'user' || $role == 'it') {
            return issue::with('user')
                ->withCount('comments')
                ->where('assignee', Auth::id())
                ->where('status', '!=', '2')
                ->orderBy('created_at', 'DESC')
                ->get()
                ->count();
        } else {
            return issue::with('user')->with('comments')
                ->where('status', '=', '0')
                ->orderBy('created_at', 'DESC')
                ->get()
                ->count();
        }
    }
    public function getIssuesfromMe()
    {
        $issueGet = issue::with('user')
            ->withCount('comments')
            ->where('created_by', Auth::id())
            // ->where('status', '!=', '2')
            ->orderBy('created_at', 'DESC')
            ->get();
        return $issueGet;
    }
    public function getIssuesClosed()
    {
        if (Auth::user()->role == 'admin') {
            $issueGet = issue::with('user')
                ->withCount('comments')
                ->where('status', '=', '2')
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $issueGet = issue::with('user')
                ->withCount('comments')
                ->where('assignee', Auth::id())
                ->where('status', '=', '2')
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        return $issueGet;
    }
    public function countIssuesClosed()
    {
        return $this->getIssuesClosed()->count();
    }
    public function getIssuewithComment()
    {
        $issueGet = DB::table('issues')
            ->join('comment_issues', 'comment_issues.issueId', '=', 'issues.id')
            ->get()
            ->groupBy('comment_issues.issueId');
        return response()->json($issueGet);
    }
    public function getIssueById($id)
    {
        $issueGet = DB::table('issues')
            ->where('issues.id', '=', $id)
            ->join('users', 'issues.created_by', '=', 'users.id')
            ->select('issues.*', 'users.name', 'users.avatar')
            ->get();
        return response()->json($issueGet);
    }
    public function getAssigneebyId($id)
    {
        $issueGet = DB::table('issues')
            ->where('issues.id', '=', $id)
            ->join('users', 'issues.assignee', '=', 'users.id')
            ->select('users.name', 'users.avatar', 'issues.id', 'issues.title')
            ->get();
        return response()->json($issueGet);
    }
    public function getApprovedbyId($id)
    {
        $issueGet = DB::table('issues')
            ->where('issues.id', '=', $id)
            ->join('users', 'issues.approved_by', '=', 'users.id')
            ->select('users.name', 'users.id', 'issues.status')
            ->get();
        return response()->json($issueGet);
    }
    public function postComment(Request $request)
    {
        $newComment = new commentIssue();
        $newComment->fromId = Auth::id();
        $newComment->issueId = $request->issueid;
        $newComment->comment = $request->comment;
        $newComment->save();

        $issueGet = issue::where('id', $newComment->issueId)->get();
        $userfind = commentIssue::with('user')->where('issueId', '=', $newComment->issueId)->get();
        $issuefind = issue::with('user')->where('id', $newComment->issueId)->get();

        // if user signed not same as created by issue
        if (Auth::id() != $issueGet[0]->created_by) {
            Mail::to($issuefind[0]->user->email)->send(new AddComment($userfind[0], $issuefind[0]));
            return response()->json(200);
        } else {
            Mail::to($userfind[0]->user->email)->send(new addCommentToCreator($userfind[0], $issuefind[0]));
            return response()->json(200);
        }
        return response()->json(201);
    }
    public function deleteComment($id)
    {
        return response()->json(commentIssue::find($id)->delete());
    }
    public function getCommentbyId($id)
    {
        return response()->json(commentIssue::with('user')->where('issueId', $id)->get());
    }
    public function approveIssue($id, Request $request)
    {
        $issue = issue::find($id);
        $issue->approved_by = Auth::id();
        $issue->status = '1';

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Approve issue ' . $issue->id . '.';
        $saveLogs->save();

        $issue->save();
        $issues = issue::with('user')->with('assigne')->get()->find($id);
        Mail::to($issues->assigne->email)->send(new makeNewIssue($issues));

        return response()->json($issues, 201);
        // return response()->json($issues);
        // return new makeNewIssue($issues);
    }
    public function closedIssue($id, Request $req)
    {
        $issue = issue::find($id);
        $issue->status = '2';

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $req->ip();
        $saveLogs->notes = 'Close issue ' . $issue->id . '.';
        $saveLogs->save();

        $issue->save();
        $issues = issue::with('user')->with('assigne')->get()->find($id);
        $sendTo = $issues->user->email;
        Mail::to($sendTo)->send(new closedIssue($issues));
        return response()->json($issues, 201);
        // return new closedIssue($issues);
        // return response()->json($issues);
    }
    public function countCommentDB($id)
    {
        return response()->json(commentIssue::where('issueId', $id)->get()->count());
    }
    public function countIssueSolvedById()
    {
        $issueGet = DB::table('issues')
            ->where('issues.assignee', '=', Auth::id())
            ->where('issues.status', '=', '2')
            ->join('users', 'issues.created_by', '=', 'users.id')
            ->select('issues.*', 'users.name', 'users.avatar')
            ->count();
        return response()->json($issueGet);
    }
    public function countIssuePendingById()
    {
        $issueGet = DB::table('issues')
            ->where('issues.assignee', '=', Auth::id())
            ->where('issues.status', '!=', '2')
            ->join('users', 'issues.created_by', '=', 'users.id')
            ->select('issues.*', 'users.name', 'users.avatar')
            ->count();
        return response()->json($issueGet);
    }

    // API FOR JOB
    public function getJob()
    {
        return jobvacancy::orderBy('created_at', 'desc')->get();
    }
    public function addJob(Request $request)
    {
        $job = new jobvacancy();
        $job->title = $request->title;
        $job->location = $request->location;
        $job->divisi = $request->divisi;
        $job->part = $request->partof;
        $job->description = $request->desc;

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Make new job vacancy ' . $job->title . '.';
        $saveLogs->save();

        $job->save();
        return response()->json($job, 201);
    }
    public function deleteJob($id, Request $request)
    {
        $career = jobvacancy::find($id);

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Delete job vacancy ' . $career->title . '.';
        $saveLogs->save();

        $career->delete();
        return response()->json([], 204);
    }
    public function getJobbyId($id)
    {
        return response()->json(jobvacancy::find($id));
    }
    public function updateJob($id, Request $request)
    {
        $job = jobvacancy::find($id);
        $job->title = $request->title;
        $job->location = $request->location;
        $job->divisi = $request->divisi;
        $job->part = $request->partof;
        $job->description = $request->desc;

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Edit/update new job vacancy ' . $job->title . '.';
        $saveLogs->save();

        $job->save();
        return response()->json($job, 201);
    }

    // BLOG API
    public function getBlog()
    {
        return response()->json(blog::with('user')->orderBy('created_at', 'DESC')->get());
    }
    public function getBlogById($id)
    {
        return response()->json(blog::find($id));
    }
    public function patchBlogById($id, Request $request)
    {
        $blog = blog::find($id);
        foreach (['title', 'description', 'category'] as $field) {
            if (isset($request->{$field})) {
                $blog->{$field} = $request->{$field};
            }
        }

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Edit/update blog ' . $blog->title . '.';
        $saveLogs->save();

        $blog->save();
        return response()->json($blog);
    }
    public function deleteBlogById($id, Request $request)
    {
        $blog = blog::find($id);

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Delete blog ' . $blog->title . '.';
        $saveLogs->save();

        $blog->delete();
        return response()->json([], 204);
    }
    public function addNewBlog(Request $request)
    {
        $blog = new blog();
        foreach (['title', 'description', 'category'] as $field) {
            if (isset($request->{$field})) {
                $blog->{$field} = $request->{$field};
            }
        }
        $blog->views = 0;
        $blog->userid = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new blog ' . $blog->title . '.';
        $saveLogs->save();

        $blog->save();
        return response()->json($blog);
    }

    // PROFILE API
    public function getProfile($username)
    {
        return response()->json(User::where('username', $username)->first());
    }
    public function updateProfile($id, Request $request)
    {
        $profile = User::find($id);
        if ($request->file('image')) {
            $lamp = $request->file('image');
            $filename =
                time() . '-' .  $lamp->getClientOriginalName();
            $lamp->move('dashboard/img/author/profile/', $filename);
            $profile->avatar = $filename;
        }
        $profile->name = $request->name;
        $profile->username = $request->username;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->gender = $request->gender;
        if (!$request->birth) {
            $profile->birth = '0000-00-00';
        } else {
            $profile->birth = $request->birth;
        }
        $profile->bio = $request->bio;
        if (!$request->instagram) {
            $profile->instagram = '-';
        } else {
            $profile->instagram = $request->instagram;
        }
        if (!$request->facebook) {
            $profile->facebook = '-';
        } else {
            $profile->facebook = $request->facebook;
        }

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Update profile data.';
        $saveLogs->save();

        $profile->save();
        Mail::to($profile->email)->send(new confirmUpdateProfile($profile));
        return response()->json($profile, 201);
        // return response($filename);
    }
    public function updatePassword($id, Request $request)
    {
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->unpassword = $request->password;
        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Update profile data password.';
        $saveLogs->save();

        $user->save();
        return response()->json($user, 201);
    }

    // QUOTE API
    public function getQuoteAll()
    {
        if ($this->getLoggedUser()->role != 'it') {
            return response()->json(quotes::with('createdBy')->where('createdId', Auth::id())->get());
        } else {
            return response()->json(quotes::with('createdBy')->get());
        }
    }
    public function addQuote(Request $request)
    {
        $quotes = new quotes();
        $quotes->quoteid = $request->quoteid;
        $quotes->quoteen = $request->quoteen;
        $quotes->createdId = $this->getLoggedUser()->id;
        $quotes->finishId = 0;
        $quotes->status = 0;
        $quotes->save();
        return response()->json($quotes, 201);
    }
    public function deleteQuote($id)
    {
        $career = quotes::find($id);
        $career->delete();
        return response()->json([], 204);
    }
    public function getQuotebyId($id)
    {
        return response()->json(quotes::with('createdBy')->where('id', $id)->get());
    }
    public function updateQuote($id, Request $request)
    {
        $quotes = quotes::find($id);
        $quotes->quoteid = $request->quoteid;
        $quotes->quoteen = $request->quoteen;
        $quotes->save();
        return response()->json($quotes, 201);
    }
    public function approvedQuote($id, Request $request)
    {
        $quote = quotes::find($id);
        $quote->finishId = Auth::id();
        $quote->status = 1;
        $quote->save();
        return response()->json($quote, 201);
    }

    // API Track Delivery
    public function getTrack(Request $request)
    {
        return response()->json(track_orders::with('createdBy')->orderBy('created_at', 'desc')->get());
    }
    public function newOrderTrack(Request $request)
    {
        $randomidreport = mt_rand(100, 999);
        $month = Date('md');

        $track = new track_orders();
        $track->created_by = $this->getLoggedUser()->id;
        $track->updated_by = $this->getLoggedUser()->id;

        $track->order_id = $request->orderid;
        $track->sender = $request->sender;
        $track->sender_city = $request->sender_city;
        $track->sender_address = $request->sender_address;
        $track->receiver = $request->receiver;
        $track->receiver_city = $request->receiver_city;
        $track->receiver_address = $request->receiver_address;
        $track->payload =  $request->payload_value . ' ' . $request->payload;
        $track->stuff_desc = $request->description;
        $track->order_status = '0';
        $track->save();

        // TRACK REPORT
        $report = new track_reports();
        $report->order_id = $track->order_id;
        $report->track_id = 'BTSA' . $month . $randomidreport;
        $report->current_location = '-';
        $report->last_location = '-';
        $report->status = '0';
        $report->container_type_system = '-';
        $report->estimated_arrival_date = '-';
        $report->updated_by = $this->getLoggedUser()->id;
        $report->save();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new order track.';
        $saveLogs->save();

        return response()->json(array(
            'track' => $track,
            'report' => $report,
        ));
    }
    public function getTrackById($id)
    {
        return response()->json(track_orders::with('createdBy')->get()->find($id));
    }
    public function postTrackById($id, Request $request)
    {
        $randomidreport = mt_rand(100, 999);
        $month = Date('md');

        $order = DB::table('track_orders')
            ->where('track_orders.id', '=', $id)
            ->update([
                'track_orders.order_status' => '1',
                'track_orders.updated_at' => \Carbon\Carbon::now(),
                'track_orders.updated_by' => $this->getLoggedUser()->name
            ]);
        $orderBy = track_orders::find($id);

        $report = DB::table('track_reports')
            ->Insert(
                [
                    'track_reports.track_id' => 'BTSA' . $month . $randomidreport,
                    'track_reports.order_id' => $orderBy->order_id,
                    'track_reports.current_location' => $request->current_location,
                    'track_reports.last_location' => '-',
                    'track_reports.container_type_system' => $request->container_type_system,
                    'track_reports.estimated_arrival_date' => $request->estimated_arrival_date,
                    'track_reports.status' => '1',
                    'track_reports.created_at' => \Carbon\Carbon::now(),
                    'track_reports.updated_at' => \Carbon\Carbon::now(),
                    'track_reports.updated_by' => $this->getLoggedUser()->name,

                    'track_reports.activity' => $request->activity,
                ]
            );

        return response()->json(array(
            'order' => $order,
            'report' => $report,
        ));
    }
    public function patchTrackById($id, Request $request)
    {
        $randomidreport = mt_rand(100, 999);
        $month = Date('md');

        $order = track_orders::find($id);
        if ($order->order_status == '1') {
            $order->order_status = '2';
        } else if ($order->order_status = '2') {
            $order->order_status = '3';
        } else if ($order->order_status = '3') {
            $order->order_status = '4';
        } else if ($order->order_status = '4') {
            $order->order_status = '5';
        } else {
            $order->order_status = '1';
        }
        $order->updated_at = \Carbon\Carbon::now();
        $order->updated_by = $this->getLoggedUser()->username;

        $getreport = DB::table('track_reports')
            ->where('track_reports.order_id', '=', $order->order_id)
            ->orderBy('track_reports.updated_at', 'DESC')
            ->first();

        $report = new track_reports();
        $report->track_id = 'BTSA' . $month . $randomidreport;
        $report->order_id = $order->order_id;
        $report->current_location = $request->current_location;
        $report->last_location = $request->last_location;
        $report->container_type_system = $getreport->container_type_system;
        $report->estimated_arrival_date = $getreport->estimated_arrival_date;
        if ($order->order_status == '1') {
            $report->status = '2';
        } else if ($order->order_status = '2') {
            $report->status = '3';
        } else if ($order->order_status = '3') {
            $report->status = '4';
        } else if ($order->order_status = '4') {
            $report->status = '5';
        } else {
            $report->status = '1';
        }
        $report->created_at = \Carbon\Carbon::now();
        $report->updated_at = \Carbon\Carbon::now();
        $report->updated_by = $this->getLoggedUser()->username;
        $report->activity = $request->activity;
        $report->save();
        $order->save();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Update status track order.';
        $saveLogs->save();

        return response()->json(array(
            'order' => $order,
            'report' => $report,
        ));
    }
    public function terminateTrack($id)
    {
        $randomidreport = mt_rand(100, 999);
        $month = Date('md');

        $order = track_orders::find($id);
        $order->order_status = '6';
        $order->updated_at = \Carbon\Carbon::now();
        $order->updated_by = $this->getLoggedUser()->username;

        $getreport = DB::table('track_reports')
            ->where('track_reports.order_id', '=', $order->order_id)
            ->orderBy('track_reports.updated_at', 'DESC')
            ->first();

        $report = new track_reports();
        $report->track_id = 'BTSA' . $month . $randomidreport;
        $report->order_id = $order->order_id;
        $report->current_location = $getreport->current_location;
        $report->last_location = $getreport->last_location;
        $report->container_type_system = $getreport->container_type_system;
        $report->estimated_arrival_date = $getreport->estimated_arrival_date;
        $report->status = '6';
        $report->created_at = \Carbon\Carbon::now();
        $report->updated_at = \Carbon\Carbon::now();
        $report->updated_by = $this->getLoggedUser()->username;
        $report->activity = $getreport->activity;
        $report->save();
        $order->save();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Terminate order track.';
        $saveLogs->save();

        return response()->json(array(
            'order' => $order,
            'report' => $report,
        ));
    }

    // NOTEPAD CONTROLLER
    public function getNotes()
    {
        return response()->json(notepad::where('userid', Auth::id())->get());
    }
    public function postNotes(Request $req)
    {
        $note = new notepad();
        $note->title = $req->title;
        $note->desc = $req->description;
        $note->label = $req->label;
        $note->favorite = 0;
        $note->userid = $this->getLoggedUser()->id;
        $note->save();
        return response()->json($note, 201);
    }
    public function deleteNote($id)
    {
        $note = notepad::find($id);
        $note->delete();
        return response()->json($note);
    }
    public function favoriteNote($id)
    {
        $note = notepad::find($id);
        $note->favorite = 1;
        $note->save();
        return response()->json($note);
    }
    public function unfavoriteNote($id)
    {
        $note = notepad::find($id);
        $note->favorite = 0;
        $note->save();
        return response()->json($note);
    }
    public function favoriteDataNotepad()
    {
        return response()->json(notepad::where('favorite', 1)
            ->where('userid', Auth::id())->get());
    }
    public function personalDataNotepad()
    {
        return response()->json(notepad::where('label', 3)
            ->where('userid', Auth::id())->get());
    }
    public function workDataNotepad()
    {
        return response()->json(notepad::where('label', 2)
            ->where('userid', Auth::id())->get());
    }
    public function socialDataNotepad()
    {
        return response()->json(notepad::where('label', 1)
            ->where('userid', Auth::id())->get());
    }
    public function importantDataNotepad()
    {
        return response()->json(notepad::where('label', 4)
            ->where('userid', Auth::id())->get());
    }

    // Goods Receipt
    public function getGoods()
    {
        if (Auth::user()->role == 'hrdga' || Auth::user()->role == 'admin') {
            return response()->json(goodsReceip::with('receiver')->orderBy('created_at', 'DESC')->get());
        } else {
            return response()->json(goodsReceip::with('receiver')->where('receiverid', Auth::id())->get());
        }
    }
    public function countGoods()
    {
        return response()->json(goodsReceip::where('receiverId', Auth::id())->where('status', '=', '0')->get()->count());
    }
    public function postGoods(Request $request)
    {
        $newGoods = new goodsReceip();
        $newGoods->userid = Auth::id();
        if ($request->receiverId) {
            $newGoods->receiverid = 0;
        } else {
            $newGoods->receiverid = $request->receiverid;
        }
        $newGoods->typeOfGoods = $request->typeOfGoods;
        $newGoods->courier = $request->courier;
        $newGoods->receiptNumber = $request->receiptNumber;
        $newGoods->description = $request->description;
        $newGoods->status = 0;

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new goods receipt ' . $newGoods->id . '.';
        $saveLogs->save();

        $newGoods->save();
        $goods = User::find($newGoods->receiverid);
        // return $goods->email;
        Mail::to($goods->email)->send(new GoodsReceive($goods, $newGoods));
        return response()->json($goods);
        // return response()->json($newGoods, 200);
    }
    public function getGoodsById($id, Request $req)
    {
        $goods = goodsReceip::find($id);
        $goods->status = 1;
        $goods->created_at = \Carbon\Carbon::now();
        $goods->save();
        return response()->json($goods, 201);
    }


    // Document API
    public function fileStore(Request $request)
    {
        $doc = $request->file('file');
        $imageName = time() . '-' .  $request->file->getClientOriginalName();
        $fileName = $request->file->getClientOriginalName();
        $request->file->move(public_path('imagePublic'), $imageName);
        $fileDocument = FileDocument::create([
            'file' => $imageName,
        ]);
        return response()->json($fileDocumFent, 201);
    }

    // Gallery API
    public function addGallery(Request $request)
    {
        $data = $request->all();
        $album = new albums();
        $album->nama_album = $request->title;

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new gallery.';
        $saveLogs->save();

        $album->save();

        $file = DB::table('file_documents')
            ->whereNull('fileId')
            ->update(array('fileId' => $album->id));
        return response()->json($file);
    }
    public function getAlbum()
    {
        $album = DB::table('albums')
            ->join('file_documents', 'albums.id', '=', 'file_documents.fileId')
            ->orderBy('file_documents.created_at', 'DESC')
            ->select(
                DB::raw('COUNT(*) as totalFile'),
                'file_documents.fileId',
                'albums.nama_album',
                'file_documents.file'
            )
            ->groupBy('fileId')
            ->get();
        return response()->json($album, 201);
    }
    // POP UP
    public function getPopup()
    {
        if (popupWindow::get()) {
            return response()->json(popupWindow::orderBy('created_at', 'DESC')->get());
        } else {
            return response('No data');
        }
    }
    public function postPopup(Request $request)
    {
        $popup = new popupWindow();
        $popup->title = $request->title;
        $popup->url = $request->url;
        $popup->updated_by = Auth::id();
        $popup->save();
        return response()->json($popup, 201);
    }

    // Candidate API
    public function getCandidate()
    {
        return response()->json(candidates::with('posisi')->with('provinsi')->with('domisili')->with('kecamatan')->with('kelurahan')->with('agama')->with('suku')->orderBy('created_at', 'DESC')->get());
    }
    public function deleteCandidate($id, Request $request)
    {
        $getUser = candidates::find($id);

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Delete candidates.';
        $saveLogs->save();

        $getUser->delete();
        return response()->json([], 204);
    }
    public function getCandidateById($id)
    {
        return response()->json(candidates::where('id', $id)->with('posisi')->with('provinsi')->with('domisili')->with('kecamatan')->with('kelurahan')->with('agama')->with('suku')->orderBy('created_at', 'DESC')->get());
    }

    // Chat API
    public function getChatFor($id)
    {
        messages::where('from', $id)->where('to', Auth::id())->update(['read' => true]);

        $chat = messages::where('from', $id)->orWhere('to', $id)->orderBy('created_at', 'ASC')->get();

        $messages = messages::where(function ($q) use ($id) {
            $q->where('from', Auth::id());
            $q->where('to', $id);
        })->orWhere(function ($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', Auth::id());
        })
            ->get();

        return response()->json($messages);
    }
    public function getListContact()
    {
        // get all user exc auth user
        $user = User::where('id', '!=', Auth::id())->where('role', '!=', 'customer')->orderBy('name', 'asc')->get();

        $unreadIds = messages::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', Auth::id())
            ->where('read', false)
            ->groupBy('from')
            ->get();

        $user = $user->map(function ($user) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $user->id)->first();

            $user->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $user;
        });
        return response()->json($user);
    }
    public function getListContactById($id)
    {
        return response()->json(User::find($id));
    }
    public function sendChat(Request $request)
    {
        $id = Auth::id();
        $message = new messages();
        $message->from = $id;
        $message->to = $request->contact_id;
        $message->text = $request->text;
        $message->save();

        broadcast(new newMessage($message));
        return response()->json($message);
    }

    // Company API
    public function getCompanyDetails()
    {
        return response()->json(company_details::get());
    }
    public function saveCompanyDetails(Request $request)
    {
        $comp = new company_details();
        $comp->icon = $request->icon;
        $comp->logo = $request->logo;
        $comp->logoblack = $request->logoblack;
        $comp->company_id = $request->company_id;
        $comp->company_name = $request->company_name;
        $comp->address = $request->address;
        $comp->city = $request->city;
        $comp->state = $request->state;
        $comp->country = $request->country;
        $comp->taxNumber = $request->taxNumber;
        $comp->phone = $request->phone;
        $comp->email = $request->email;
        $comp->site = $request->site;
        $comp->meta_description = $request->meta_description;
        $comp->meta_keywords = $request->meta_keywords;
        $comp->save();
        return response()->json($comp, 201);
    }
    public function saveMetaCompanyDetails($id, Request $request)
    {
        $comp = company_details::find($id);
        // $comp->meta_description = $request->meta_description;
        // $comp->meta_keywords = $request->meta_keywords;
        // $comp->save();
        return response()->json($comp, 201);
    }
    public function userGetWithOutLoggedIn()
    {
        return response()->json(User::where('id', '!=', Auth::id())->orderBy('name', 'asc')->get());
    }
    public function getAssignee()
    {
        return response()->json(User::where('id', '!=', Auth::id())->where('divisi', '!=', 'developer')->orderBy('name', 'asc')->get());
    }

    // CUSTOMERS API CONTROLLER
    public function getCustomers()
    {
        return response()->json(User::where('role', 'customer')->orderBy('name', 'asc')->get());
    }
    public function getCustomerbyId($id)
    {
        return response()->json(User::find($id));
    }
    public function deleteCustomer($id)
    {
        $getUser = User::find($id);
        // $getUser->status = '2';
        $getUser->delete();
        return response()->json([], 204);
    }
    public function addCustomer(Request $request)
    {
        $customer = new User();
        // User Section
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->username = strtolower($request->name);
        $customer->role = 'customer';
        $customer->department = '-';
        $customer->status = '1';
        $customer->divisi = '-';
        $customer->gender = '-';
        $customer->organisation = '-';
        $customer->phone = '-';
        $customer->avatar = '7.jpg';
        $customer->cover = '-';
        $customer->password = Hash::make($request->password);
        $customer->unpassword = $request->password;
        $customer->createdBy = Auth::id();
        $customer->logip = $request->ip();
        $customer->lastLogin = '0';

        // Customer Section
        $customer->customerCode = $request->customerCode;
        $customer->customerName = $request->customerName;
        $customer->customerAddress = $request->customerAddress;
        $customer->customerCity = $request->customerCity;
        $customer->customerPhone = $request->customerPhone;
        $customer->customerEmail = $request->email;
        $customer->customerWebsite = $request->customerWebsite;
        $customer->customerNPWP = $request->customerNPWP;

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new customer ' . $customer->id . ' to user management.';
        $saveLogs->save();

        $customer->save();
        return response()->json($customer, 201);
    }
    public function countCustomers()
    {
        $userCount = DB::table('users')
            ->where('role', '=', 'customer')
            ->get()
            ->count();
        return response()->json($userCount);
    }
    public function updateCustomer($id, Request $request)
    {
        $user = User::find($id);
        foreach ([
            'name', 'email', 'customerCode', 'customerName', 'customerAddress',
            'customerCity', 'customerPhone', 'customerEmail', 'customerWebsite', 'customerNPWP'
        ] as $field) {
            if (isset($request->{$field})) {
                $user->{$field} = $request->{$field};
            }
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->unpassword = $request->password;
        }

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Edit/update customer ' . $customer->id . ' on user management.';
        $saveLogs->save();

        $user->save();
        return response()->json($user);
    }

    // SUPPLIERS API CONTROLLER
    public function getSuppliers()
    {
        return response()->json(User::where('role', 'supplier')->orderBy('name', 'asc')->get());
    }
    public function getSuppliersbyId($id)
    {
        return response()->json(User::find($id));
    }
    public function deleteSuppliers($id)
    {
        $getUser = User::find($id);
        // $getUser->status = '2';
        $getUser->delete();
        return response()->json([], 204);
    }
    public function addSuppliers(Request $request)
    {
        $customer = new User();
        // User Section
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->username = strtolower($request->name);
        $customer->role = 'supplier';
        $customer->department = '-';
        $customer->status = '1';
        $customer->divisi = '-';
        $customer->gender = '-';
        $customer->organisation = '-';
        $customer->phone = '-';
        $customer->avatar = '-';
        $customer->cover = '-';
        $customer->password = Hash::make($request->password);
        $customer->unpassword = $request->password;
        $customer->createdBy = Auth::id();
        $customer->logip = $request->ip();
        $customer->lastLogin = '0';

        // Customer Section
        $customer->customerCode = $request->customerCode;
        $customer->customerName = $request->customerName;
        $customer->customerAddress = $request->customerAddress;
        $customer->customerCity = $request->customerCity;
        $customer->customerPhone = $request->customerPhone;
        $customer->customerEmail = $request->email;
        $customer->customerWebsite = $request->customerWebsite;
        $customer->customerNPWP = $request->customerNPWP;

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new supplier ' . $customer->id . ' to user management.';
        $saveLogs->save();

        $customer->save();
        return response()->json($customer, 201);
    }
    public function countSuppliers()
    {
        $userCount = DB::table('users')
            ->where('role', '=', 'supplier')
            ->get()
            ->count();
        return response()->json($userCount);
    }
    public function updateSuppliers($id, Request $request)
    {
        $user = User::find($id);
        foreach ([
            'name', 'email', 'customerCode', 'customerName', 'customerAddress',
            'customerCity', 'customerPhone', 'customerEmail', 'customerWebsite', 'customerNPWP'
        ] as $field) {
            if (isset($request->{$field})) {
                $user->{$field} = $request->{$field};
            }
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->unpassword = $request->password;
        }

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Edit/update customer ' . $user->id . ' on user management.';
        $saveLogs->save();

        $user->save();
        return response()->json($user);
    }

    // Warehouse
    public function getWarehouse()
    {
        if (Auth::user()->role == 'customer') {
            // If logged user is having role as CUSTOMER
            // then warehouse shows that having this ID CUSTOMER
            $warehouse = DB::table('warehouse_lists')
                ->join('warehouse_customers', 'warehouse_lists.id', '=', 'warehouse_customers.warehouse_id')
                ->join('users', 'warehouse_lists.created_by', '=', 'users.id')
                ->where('warehouse_customers.customer_id', '=', Auth::id())
                ->orderBy('warehouse_lists.warehouse_name', 'ASC')
                ->get();
            return $warehouse;
        } else {
            return response()->json(warehouseList::with('user')->with('createdBy')->orderBy('created_at', 'DESC')->get());
        }
    }
    public function postWarehouse(Request $request)
    {
        $warehouse = new warehouseList();
        $warehouse->warehouse_code = $request->warehouse_code;
        $warehouse->warehouse_name = $request->warehouse_name;
        $warehouse->address = $request->address;
        $warehouse->remarks = $request->remarks;
        $warehouse->pic = $request->pic;
        $warehouse->created_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new warehouse ' . $warehouse->warehouse_name . '.';
        $saveLogs->save();

        $warehouse->save();

        if (Auth::user()->role == 'customer') {
            $warehouseCust = new warehouseCustomer();
            $warehouseCust->warehouse_id = $warehouse->id;
            $warehouseCust->customer_id = Auth::id();
            $warehouseCust->save();
        }
        return response()->json($warehouse, 200);
    }
    public function getWarehouseById($id)
    {
        return response()->json(warehouseList::find($id));
    }
    public function deleteWarehouseById($id)
    {
        return response()->json(warehouseList::find($id)->delete());
    }
    public function postWarehouseById($id, Request $request)
    {
        $warehouse = warehouseList::find($id);
        $warehouse->warehouse_code = $request->warehouse_code;
        $warehouse->warehouse_name = $request->warehouse_name;
        $warehouse->address = $request->address;
        $warehouse->remarks = $request->remarks;
        $warehouse->pic = $request->pic;

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Edit/update warehouse ' . $warehouse->warehouse_name . '.';
        $saveLogs->save();

        $warehouse->save();
        return response()->json($warehouse, 201);
    }

    // Warehouse Customer
    public function getWarehouseCustomer($id)
    {
        return response()->json(warehouseCustomer::where('warehouse_id', $id)->with('warehouseDetail')->with('customerDetail')->orderBy('created_at', 'DESC')->get());
        // return response($id);
    }
    public function postWarehouseCustomer(Request $request, $id)
    {
        $warehouse = new warehouseCustomer();
        $warehouse->warehouse_id = $id;
        $warehouse->customer_id = $request->customerId;

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add customer list to warehouse ' . $warehouse->warehouse_name . '.';
        $saveLogs->save();

        $warehouse->save();
        return response()->json($warehouse, 200);
    }
    public function getWarehouseCustomerById($id)
    {
        return response()->json(warehouseCustomer::find($id));
    }
    public function deleteWarehouseCustomerById($id)
    {
        return response()->json(warehouseCustomer::find($id)->delete());
    }
    public function postWarehouseCustomerById($id, Request $request)
    {
        $warehouse = warehouseCustomer::find($id);
        $warehouse->warehouse_id = $id;
        $warehouse->customer_id = $request->customerId;

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Edit/update customer list to warehouse ' . $warehouse->warehouse_name . '.';
        $saveLogs->save();

        $warehouse->save();
        return response()->json($warehouse, 201);
    }

    // Stock Group
    public function getStockGroup()
    {
        if (Auth::user()->role == 'customer') {
            return response()->json(stockGroup::where('created_by', Auth::id())->with('user')->orderBy('created_at', 'DESC')->get());
        } else {
            return response()->json(stockGroup::with('user')->orderBy('created_at', 'DESC')->get());
        }
    }
    public function postStockGroup(Request $request)
    {
        $stock = new stockGroup();
        $stock->stockgroup_id = $request->stockgroup_id;
        $stock->name = $request->name;
        $stock->remarks = $request->remarks;
        $stock->created_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new stock group ' . $stock->name . '.';
        $saveLogs->save();

        $stock->save();
        return response()->json($stock, 200);
    }
    public function countStockGroup()
    {
        $stockCount = DB::table('stock_groups')
            ->get()
            ->count();
        return response()->json($stockCount);
    }
    public function getStockGroupById($id)
    {
        return response()->json(stockGroup::find($id));
    }
    public function postStockGroupById($id, Request $request)
    {
        $stock = stockGroup::find($id);
        $stock->stockgroup_id = $request->stockgroup_id;
        $stock->name = $request->name;
        $stock->remarks = $request->remarks;
        $stock->created_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Edit/update stock group ' . $stock->name . '.';
        $saveLogs->save();

        $stock->save();
        return response()->json($stock, 201);
    }
    public function deleteStockGroupById($id)
    {
        return response()->json(stockGroup::find($id)->delete());
    }

    // ItemGroup
    public function getItemGroup()
    {
        if (Auth::user()->role == 'customer') {
            return response()->json(itemGroup::where('created_by', Auth::id())->with('user')->orderBy('created_at', 'DESC')->get());
        } else {
            return response()->json(itemGroup::with('user')->orderBy('created_at', 'DESC')->get());
        }
    }
    public function postItemGroup(Request $request)
    {
        $itemGroup = new itemGroup();
        $itemGroup->itemgroup_id = $request->itemgroup_id;
        $itemGroup->name = $request->name;
        $itemGroup->remarks = $request->remarks;
        $itemGroup->created_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new item group ' . $itemGroup->name . '.';
        $saveLogs->save();

        $itemGroup->save();
        return response()->json($itemGroup, 200);
    }
    public function getItemGroupById($id)
    {
        return response()->json(itemGroup::with('user')->find($id));
    }
    public function postItemGroupById($id, Request $request)
    {
        $itemGroup = itemGroup::find($id);
        $itemGroup->itemgroup_id = $request->itemgroup_id;
        $itemGroup->name = $request->name;
        $itemGroup->remarks = $request->remarks;
        $itemGroup->created_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Edit/update item group ' . $itemGroup->name . '.';
        $saveLogs->save();

        $itemGroup->save();
        return response()->json($itemGroup, 200);
    }
    public function countItemGroup()
    {
        $ItemCount = DB::table('item_groups')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    public function deleteItemGroupById($id)
    {
        return response()->json(itemGroup::find($id)->delete());
    }

    // Inventory Item
    public function getInventoryItem()
    {
        if (Auth::user()->role == 'customer') {
            return response()->json(inventoryItem::where('customerId', Auth::id())->with('itemGroup')->with('customer')->orderBy('created_at', 'DESC')->get());
        } else {
            return response()->json(inventoryItem::with('itemGroup')->with('customer')->orderBy('created_at', 'DESC')->get());
        }
    }
    public function postInventoryItem(Request $request)
    {
        $inventory = new inventoryItem();
        $inventory->item_code = $request->item_code;
        $inventory->item_name = $request->item_name;
        $inventory->qty = 0;
        $inventory->type = $request->type;
        $inventory->brand = $request->brand;
        $inventory->item_group = $request->item_group;
        $inventory->width = $request->width;
        $inventory->length = $request->length;
        $inventory->thickness = $request->thickness;
        $inventory->nt_weight = $request->nt_weight;
        $inventory->gr_weight = $request->gr_weight;
        $inventory->volume = $request->volume;
        $inventory->unit = $request->unit;
        $inventory->customerId = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new inventory item ' . $inventory->item_code . '.';
        $saveLogs->save();

        $inventory->save();
        return response()->json($inventory, 200);
    }
    public function getInventoryItemById($id)
    {
        return response()->json(inventoryItem::find($id));
    }
    public function postInventoryItemById($id, Request $request)
    {
        $inventory = inventoryItem::find($id);
        $inventory->item_code = $request->item_code;
        $inventory->item_name = $request->item_name;
        $inventory->type = $request->type;
        $inventory->brand = $request->brand;
        $inventory->item_group = $request->item_group;
        $inventory->width = $request->width;
        $inventory->length = $request->length;
        $inventory->thickness = $request->thickness;
        $inventory->nt_weight = $request->nt_weight;
        $inventory->gr_weight = $request->gr_weight;
        $inventory->volume = $request->volume;
        $inventory->unit = $request->unit;

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Edit/update inventory item ' . $inventory->item_code . '.';
        $saveLogs->save();

        $inventory->save();
        return response()->json($inventory, 200);
    }
    public function countInventoryItem()
    {
        $ItemCount = DB::table('inventory_items')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    public function deleteInventoryItemById($id)
    {
        return response()->json(inventoryItem::find($id)->delete());
    }

    // History item
    public function getHistoryItemById($id, Request $req)
    {
        $data = [];
        if (isset($req->fromDate) && isset($req->toDate)) {
            $data = itemHistory::where('itemId', $id)->whereBetween('date', [$req->fromDate, $req->toDate])->with('item', 'detailItemIn', 'detailItemOut')->orderBy('created_at', 'DESC')->get();
        }
        else {
            $data = itemHistory::where('itemId', $id)->with('item', 'detailItemIn', 'detailItemOut')->orderBy('created_at', 'DESC')->get();
        }

        foreach ($data as $elm) {
            $elm->itemNumber = $elm->detailItemIn['pi_number'] ?? $elm->detailItemOut['si_number'];
        }

        return response()->json($data);
    }
    public function sumQtyInHistoryItem($id)
    {
        $getHistory = itemHistory::where('itemId', $id)->get();
        if (!$getHistory) {
            return '0';
        } else {
            $getPINum = $getHistory[0]->itemInId;
            return response()->json(itemsPurchase::where('item_code', $id)->where('pi_status', 2)->sum('qtyShipped'));
        }
    }
    public function sumQtyOutHistoryItem($id)
    {
        $getHistory = itemHistory::where('itemId', $id)->get();
        if (!$getHistory) {
            return '0';
        } else {
            $getSINumb = $getHistory[0]->itemOutId;
            return response()->json(itemsSales::where('item_code', $id)->where('si_status', 2)->sum('qtyShipped'));
        }
    }

    // tambah jumlah cuti disetiap tanggal yang sudah ditentukan
    public function plusOneEachTen()
    {
        $jmlhCuti = '6';
        $getDate = Date("d");

        // Tentukan tanggal
        if ($getDate == '10') {
            // Tambah 1 jika tanggal diatas valid
            $jmlhCuti += 1;
        }
        return response()->json($jmlhCuti);
    }

    // USER ACTIVITY LOGS
    public function getActivityLogs()
    {
        if (Auth::user()->role == 'admin') {
            return response()->json(userLogs::with('user')->orderBy('created_at', 'DESC')->get());
        } else {
            return response()->json(userLogs::with('user')->where('userId', Auth::id())->orderBy('created_at', 'DESC')->get());
        }
    }

    // DOCUMENTS DELIVERY
    public function getDocumentsDelivery()
    {
        if (Auth::user()->role != 'customer' || Auth::user()->role != 'supplier') {
            return documentsDelivery::where('created_by', Auth::id())->with('sender', 'createdBy', 'updatedBy')->orderBy('created_at', 'DESC')->get();
        } else {
            return documentsDelivery::with('sender', 'createdBy', 'updatedBy')->orderBy('created_at', 'DESC')->get();
        }
    }
    public function postDocumentsDelivery(Request $request)
    {
        $deliveryDocOrd = new documentsDelivery();
        $deliveryDocOrd->ddr_number = $request->ddr_number;
        $deliveryDocOrd->senderName = Auth::id();
        $deliveryDocOrd->courier = $request->courier;
        $deliveryDocOrd->status = 1;
        $deliveryDocOrd->created_by = Auth::id();
        $deliveryDocOrd->updated_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new Documents Delivery ' . $deliveryDocOrd->ddr_number . '.';
        $saveLogs->save();

        $deliveryDocOrd->save();

        $itemGet = DB::table('item_documents_deliveries')
            ->where('status', '=', '1')
            // PO Status 2, means having a Document Delivery ID
            ->update(array('ddrId' => $deliveryDocOrd->ddr_number, 'status' => '2'));
        $ddrGet = documentsDelivery::where('ddr_number', $deliveryDocOrd->ddr_number)->with('sender', 'createdBy', 'updatedBy')->first();
        Mail::to('ga2@btsa.co.id')->send(new newDocumentDelivery($ddrGet));

        return response()->json($deliveryDocOrd, 200);
    }
    public function getDocumentsDeliveryByDdrNumber($ddr_number)
    {
        return response()->json(documentsDelivery::where('ddr_number', $ddr_number)->with('sender', 'createdBy', 'updatedBy')->first());
    }
    public function postDocumentsDeliveryByDdrNumber($ddr_number, Request $request)
    {
        $documentsUpdate = DB::table('documents_deliveries')
            ->where('ddr_number', '=', $ddr_number)
            ->update(array(
                'senderName' => $request->senderName,
                'courier' => $request->courier,
                'status' => $request->status,
                'updated_by' => Auth::id(),
            ));

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Update Documents Delivery ' . $ddr_number . '.';
        $saveLogs->save();

        return response()->json($documentsUpdate, 200);
    }
    public function takenDocumentsDeliveryByDdrNumber($ddr_number, Request $request)
    {
        // Update status to 1, means it is taken by courier
        $statusDDR = documentsDelivery::where('ddr_number', $ddr_number)
            ->update(array(
                'status' => 1,
                'courier' => $request->courier,
            ));
        return response()->json($statusDDR);
    }
    public function deleteDocumentsDeliveryById($id, Request $request)
    {
        $purchaseOrd = documentsDelivery::find($id);
        $itemOnDDR = itemOndocumentsDelivery::where('ddrId', $purchaseOrd->ddr_number)->get();
        foreach ($itemOnDDR as $itemDDRs) {
            $itemDDRs->delete();
        }

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Delete Documents Delivery ' . $purchaseOrd->ddr_number . '.';
        $saveLogs->save();

        $purchaseOrd->delete();
        return response()->json(201);
    }
    public function countDocumentsDelivery()
    {
        $ItemCount = DB::table('documents_deliveries')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\album_photos;
use App\albums;
use App\changeLog;
use App\commentIssue;
use App\id_agamas;
use App\issue;
use App\id_domisilis;


class apiController extends Controller
{
    public function getLoggedUser()
    {
        return User::find(Auth::id());
    }
    public function getUsers()
    {
        return response()->json(User::all());
    }
    public function deleteUser($id)
    {
        $getUser = User::find($id);
        $getUser->delete();
        return response()->json([], 204);
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
        } else {
            $arr = array(2, 4, 6);
            shuffle($arr);
            $randVal = $arr[0];
            $user->avatar = $randVal . '.jpg';
        }
        $user->password = Hash::make($request->password);
        $user->createdBy = Auth::id();
        $user->logip = $request->ip();
        $user->lastLogin = '0';
        $user->save();

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
    public function updateUser($id, Request $request)
    {
        $user = User::find($id);
        foreach (['name', 'role', 'department', 'divisi', 'gender', 'email'] as $field) {
            if (isset($request->{$field})) {
                $user->{$field} = $request->{$field};
            }
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return response()->json($user);
    }
    //
    // ISSUE API
    public function addNewIssue(Request $request)
    {
        $issue = new issue();
        $issue->title = $request->title;
        $issue->issue = $request->description;
        $issue->status = '0';
        $issue->assignee = $request->assignee;
        $issue->priority = $request->priority;
        $issue->approved_by = 0;
        $issue->created_by = auth()->user()->id;
        $issue->save();
        return response()->json($issue, 201);
    }
    public function getIssues()
    {
        $issueGet = DB::table('issues')
            ->join('users', 'issues.created_by', '=', 'users.id')
            ->where('issues.status', '!=', '2')
            ->where('issues.assignee', Auth::id())
            ->select('issues.*', 'users.name')
            ->get();
        return $issueGet;
    }
    public function getIssuewithComment()
    {
        $issueGet = DB::table('issues')
            ->join('comment_issues', 'comment_issues.issueId', '=', 'issues.id')
            ->get()
            // ->select(array(DB::Raw('COUNT(comment_issues.issueId) as countId')))
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
        return response()->json($newComment, 201);
    }
    public function getCommentbyId($id)
    {
        $getComment = DB::table('comment_issues')
            ->where('comment_issues.issueId', '=', $id)
            ->join('users', 'comment_issues.fromId', '=', 'users.id')
            ->select('comment_issues.*', 'users.name')
            ->get();
        return response()->json($getComment);
    }
    public function approveIssue($id)
    {
        $issue = issue::find($id);
        $issue->approved_by = Auth::id();
        $issue->status = '1';
        $issue->save();
        return response()->json($issue, 201);
    }
    public function closedIssue($id, Request $req)
    {
        $issue = issue::find($id);
        $issue->status = '2';
        $issue->save();
        return response()->json($issue, 201);
    }
    public function countCommentDB($id)
    {
        return response()->json(commentIssue::where('issueId', $id)->get()->count());
    }
}

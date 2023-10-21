@extends('layouts.admin')
@section('content')
<div class="addusermodal hidden fixed z-50 w-3/5 h-3/4 bg-white -translate-x-1/2 left-1/2 shadow-lg overflow-hidden rounded-lg">
    <div class="wrappers flex h-full w-full">
        <div class="modal-input-group relative w-full px-4 py-8">
            <div class="flex justify-between pr-5">
                <p class="font-bold px-6">Add New User</p>
                <button id="closemodal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                      </svg>
                </button>
            </div>
            <form action="{{ route('user.addpost')}}" method="POST" class="input mt-4 px-6">
                @csrf
                <div class="username py-1">
                    <label for="">
                        Username
                    </label>
                    <input class="w-full rounded-md focus:outline-none focus:ring-2 ring-[#003034] bg-gray-100 my-2 p-2" type="text" name="name" id="username" placeholder="Type An Username Here">

                </div>
                <div class="py-1">
                    <label for="">
                        Password
                    </label>
                    <input class="w-full rounded-md focus:outline-none focus:ring-2 ring-[#003034] bg-gray-100 my-2 p-2" type="password" name="password" id="password" placeholder="Type A Password Here">

                </div>
                <div class="py-1">
                    <label for="">
                        Role
                    </label>
                    <select class="w-full rounded-md focus:outline-none focus:ring-2 ring-[#003034] bg-gray-100 my-2 p-2" name="role_id" id="">
                          <option value="role">Select User Role</option>
                        @foreach($roles as $role)
                          <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-[#003034] py-2 text-white px-4 rounded-md mt-4 w-full">
                    Submit
                </button>
            </form>
        </div>
    </div>

</div>
    <div class="headers flex justify-between">
        <h1 class="text-2xl font-bold">Add User</h1>
        <button id="openaddmodal" class="add-user bg-[#003034] text-white px-3 py-2 rounded-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-people-fill" viewBox="0 0 16 16">
                <path
                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
            </svg>
        </button>
    </div>
    <div class="user-list w-full mt-8 mb-8">
        <table class="w-full">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $users  as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ ucfirst($user->roles->name) }}</td>
                    <td>
                        <button class="bg-gradient-to-r from-yellow-600 to-yellow-400 p-2 text-white rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                            </svg>
                        </button>
                        <button class="bg-gradient-to-r from-red-600 to-red-400 p-2 text-white rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

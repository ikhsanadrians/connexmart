@extends('layouts.admin')
@section('content')
    <div
        class="addcategorymodal hidden fixed z-50 w-3/5 h-3/4 bg-white -translate-x-1/2 left-1/2 shadow-lg overflow-hidden rounded-lg">
        <div class="wrappers flex h-full w-full">
            <div class="modal-input-group relative w-full px-4 py-8 overflow-y-auto">
                <div class="flex justify-between pr-5">
                    <p class="font-bold px-6"><span id="user-name-modal">Tambah Kategori</span></p>
                    <button id="closegoodcategorymodal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-x-lg"
                            viewBox="0 0 16 16">
                            <path
                                d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                        </svg>
                    </button>
                </div>
                <form class="input mt-8 px-6" action="{{ route('mart.goods.category.post') }}" method="POST">
                    @csrf
                    <div class="username py-1">
                        <label for="username">
                            Nama Kategori
                        </label>
                        <input data-userid="" id="username-input"
                            class="w-full rounded-md focus:outline-none focus:ring-2 ring-[#303fe2] bg-gray-100 my-2 p-2"
                            type="text" name="name" id="goods" placeholder="Masukan Nama Kategori">
                    </div>
                    <button type="submit" id="add-btn-goods"
                        class="submit-btn bg-[#303fe2] py-2 text-white px-4 rounded-md mt-4 w-full">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div id="updategoodscategorymodal"
        class="updategoodscategorymodal hidden fixed z-50 w-3/5 h-3/4 bg-white -translate-x-1/2 left-1/2 shadow-lg overflow-hidden rounded-lg">
        <div class="wrappers flex h-full w-full ">
            <div class="modal-input-group relative w-full px-4 py-8 overflow-y-auto">
                <div class="flex justify-between pr-5">
                    <p class="font-bold px-6"><span id="user-name-modal">Update Kategori</span></p>
                    <button id="closegoodcategorymodalupdate">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red"
                            class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path
                                d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                        </svg>
                    </button>
                </div>
                <form class="input mt-8 px-6" action="{{ route('mart.goods.category.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="username py-1">
                        <label for="username">
                            Nama Kategori
                        </label>
                        <input type="hidden" id="category_update_id" name="category_id">
                        <input id="category-name-input-update"
                            class="w-full rounded-md focus:outline-none focus:ring-2 ring-[#303fe2] bg-gray-100 my-2 p-2"
                            type="text" name="name" id="goods" placeholder="Masukan Nama Kategori">
                    </div>
                    <button type="submit" id="update-form-category"
                        class="submit-btn bg-[#303fe2] py-2 text-white px-4 rounded-md mt-4 w-full">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="headers flex justify-between">
        <h1 class="text-2xl font-bold">Tambah Kategori</h1>
        <button id="opengoodcategorymodal"
            class="add-user bg-[#303fe2] text-white px-3 py-2 hover:bg-slate-300 hover:text-[#303fe2] transition cursor-pointer rounded-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-fill"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001 6.971 2.789Zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z" />
            </svg>
        </button>
    </div>
    <div class="searchandfilter flex items-center gap-3">
        <div class="search mt-2 relative flex items-center">
            <svg class="absolute left-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
            <input type="text" placeholder="Cari Kategori" class="pl-8 pr-4 py-2 rounded-md focus:outline-none">
        </div>
        <div
            class="filter bg-[#303fe2] text-white mt-2 p-[11px] hover:bg-slate-300 hover:text-[#003034] rounded transition cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-funnel-fill" viewBox="0 0 16 16">
                <path
                    d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z" />
            </svg>
        </div>
    </div>
    <div class="products-list w-full mt-8 mb-8">
        <table class="w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jumlah Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td class="category-id" data-name="{{ $category->name }}" data-categoryid="{{ $category->id }}">
                            {{ $key + 1 }}</td>
                        <td class="category-thumbnail flex justify-center border-none">{{ $category->name }}</td>
                        <td class="category-totalproduct" data-description="{{ $category->desc }}">
                            {{ count($category->products) }}
                        </td>
                        <td>
                            <div class="action-wrappers flex items-center gap-2 justify-center">
                                <button id="{{ $category->id }}" data-id="{{ $category->name }}"
                                    class="edit-goods-categoty-update-btn bg-gradient-to-r from-yellow-600 to-yellow-400 p-2 text-white rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                    </svg>
                                </button>
                                <form action="{{ route('mart.goods.category.delete') }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                                    <button type="submit"
                                        class="delete-btn-goods-update bg-gradient-to-r from-red-600 to-red-400 p-2 text-white rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

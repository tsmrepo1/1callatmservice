@extends('admin.layouts.main')
@section('content')
<!-- Page -->
<div class="page">
    <div class="page-main">
        @extends('admin.layouts.sidebar')
        <!-- App-Content -->
        <div class="app-content main-content">
            <div class="side-app">
                @extends('admin.layouts.nav')
                <!--Page header-->
                <div class="page-header">
                    <div class="page-leftheader">
                        <!-- <h4 class="page-title mb-0">Add User</h4> -->
                    </div>
                    <div class="page-rightheader">

                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">Add Blog</h3>
                            </div>
                            <div class="card-body pb-2">
                                <form action="{{route('add_blog_action')}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label><strong>Title</strong> <span class="required_star">*</span></label>
                                            <input class="form-control mb-4" value="{{old('title')}}" placeholder="Title" type="text" name="title">
                                            @error('title')
                                            <span class="text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label><strong>Image <span class="required_star">*</span></strong></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image">
                                                <label class="custom-file-label">Upload Image</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label><strong>Short Description <span class="required_star">*</span></strong></label>
                                            <textarea name="short_desc" placeholder="Short Description" class="form-control">{{old('short_desc')}}</textarea>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label><strong>Description <span class="required_star">*</span></strong></label>
                                            <textarea name="description" class="content">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                    <label class="text text-primary"><strong>SEO Tags:</strong></label>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label><strong>Meta Title</strong></label>
                                            <input class="form-control mb-4" value="{{old('meta_title')}}" placeholder="Meta Title" type="text" name="meta_title">
                                            @error('meta_title')
                                            <span class="text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label><strong>Meta Description</strong></label>
                                            <input class="form-control mb-4" value="{{old('meta_desc')}}" placeholder="Meta Description" type="text" name="meta_desc">
                                            @error('meta_desc')
                                            <span class="text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label><strong>Meta Keyword</strong></label>
                                            <input class="form-control mb-4" value="{{old('meta_keyword')}}" placeholder="Meta Keyword" type="text" name="meta_keyword">
                                            @error('meta_keyword')
                                            <span class="text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-info" value="Save">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Row-1 -->
                </div>
            </div>
            <!-- End app-content-->
        </div>
        @endsection
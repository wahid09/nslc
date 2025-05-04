@extends('layouts.backend.app')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                    @role('super-admin')
                    সুপার অ্যাডমিন ড্যাশবোর্ড
                    @elseif('system-admin')
                       সিস্টেম অ্যাডমিন ড্যাশবোর্ড
                    @else
                       এরিয়া অ্যাডমিন ড্যাশবোর্ড
                        @endrole
                        <div class="page-title-subheading">
                            সেপকস এর অ্যাডমিন পেনেলে আপনাকে স্বাগতম ! সেপকস এর প্রতিটি ইনফরমেশন এই সাইটটির জন্য অতন্ত্য
                            গুরুত্বপূর্ণ। তাই তথ্য হালনাগাদ করার সময় সতর্কতা অবলম্বন করুন।
                        </div>
                </div>
            </div>
            <div class="page-title-actions">

                <div class="d-inline-block dropdown">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">সেপকস</div>
                        <div class="widget-subheading">সর্বমোট ব্যবহারকারী</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$sapoxUser}}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">লেডিস ক্লাব</div>
                        <div class="widget-subheading">সর্বমোট ব্যবহারকারী</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$leadisClubUser}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-grow-early">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">চিলড্রেন ক্লাব

                        </div>
                        <div class="widget-subheading">সর্বমোট ব্যবহারকারী</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$childernClubUser}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Products Sold</div>
                        <div class="widget-subheading">Revenue streams

                        </div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>$14M</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">সক্রিয় ব্যবহারকারীর তালিকা
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>নাম</th>
                            <th class="text-center">ক্লাব</th>
                            <th class="text-center">অঞ্চল</th>
                            <th class="text-center">স্টেটাস</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            @if($user->isOnline())
                                <tr>
                                    <td class="text-center text-muted">{{$loop->index+1}}</td>
                                    <td>{{$user->name_bn ? $user->name_bn : $user->username}}</td>
                                    <td class="text-center">{{$user->club->name_bn}}</td>
                                    <td class="text-center">{{$user->area->name_bn}}</td>
                                    <td class="text-center">Online
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center card-footer">

                </div>
            </div>
        </div>
    </div>

@endsection

@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">SEO list</a></li>
            </ol>
        </div>		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card">                
                <div class="card-body">
                    <div class="card-header pt-0">
                        <h4 class="card-title">SEO List</h4>
                        <a href="{{URL::to('superadmin/add-seo')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i> Add SEO
                        </a> 
                    </div> 
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="text-left">Sr no</th>
                                    <th class="text-left">Name</th>
                                    <th class="text-left">SEO Title</th>
                                    <th class="text-left">Meta Description</th>
                                    <th class="text-left">Meta Tags</th>                                   
                                    <th class="text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($SEO_list)>0)
                                    @php $i = 1; @endphp
                                    @foreach($SEO_list as $seo)                                   
                                        <tr>
                                            <td style="font-size:15px;text-align:left;">{{$i}}</td>
                                            <td style="font-size:15px;text-align:left;">{{ucwords(str_replace('-', ' ', $seo->page_Name))}}</td>
                                            <td style="font-size:15px;text-align:left;">{{$seo->seo_Title}}</td>
                                            <td style="font-size:15px;text-align:left;">
                                                @if(!empty($seo->meta_description))
                                                    {!! Str::of($seo->meta_description)->words(10, '...') !!}
                                                @else 
                                                    Null
                                                @endif
                                            </td>
                                            <td style="font-size:15px;text-align:left;">
                                            @if(!empty($seo->meta_tags))
                                                    @php
                                                        $tags = explode(',', $seo->meta_tags);                                        
                                                    @endphp
                                                @foreach($tags as $key=> $tag)
                                                    <span class="tm-tag tm-tag-info">
                                                        <span>{{$tag}}</span>                                                
                                                    </span>                                        
                                                @endforeach
                                            @endif
                                            </td>                                     
                                            <td style="font-size:15px;text-align:left;">
                                                <a href="{{ URL::to('superadmin/seo/edit/'.$seo->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                        @php $i++; @endphp
                                    @endforeach
                                @else 
                                    <tr>
                                        <td style="font-size:15px;text-align:left;">Null</td>
                                        <td style="font-size:15px;text-align:left;">Null</td>
                                        <td style="font-size:15px;text-align:left;">Null</td>                                      
                                        <td style="font-size:15px;text-align:left;">
                                            <a href="" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                            <thead>
                                <tr>
                                    <th class="text-left">Sr no</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">SEO Title</th>
                                    <th class="text-center">Meta Description</th>
                                    <th class="text-left">Meta Tags</th>                                    
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                        {!! $SEO_list->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection
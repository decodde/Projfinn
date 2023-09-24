@extends('_partials.dashboard.master')
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h5 class="content-header-title">Documents</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL('/dashboard/e')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Documents
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="row">
        <div class="col-md-12">
            <div class="card px-1">
                <div class="card-header">
                    <h2 class="font-weight-normal font-size-22px f-2 m-0">Documents</h2>
                    <p class="font-size-14px p-0 m-0 pt-1">- CAC Document <a class="font-size-14px pb-0 mb-0">Your Official Corporate Affairs Commission Document.</a></p>
                </div>
                <div class="card-content">
                    <hr class="p-0 m-0">

                    <div class="card-body">
                        @if(count($documents) > 0)
                            @if(count($documents) < 1)
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#uploadDocument" class="pull-right btn btn-sm btn-success">Upload document</a>
                                <br><br>
                            @endif

                            <table class="table table-striped">
                                <tbody>
                                @foreach($documents as $key => $document)
                                    <tr>
                                        <td>{{ ucfirst($document->type) }}</td>
                                        <td>
                                            <a href="{{ $document->file }}">View file</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteDocument{{ $key + 1 }}"><i class="mdi mdi-delete"></i>&nbsp;Delete</a>
                                        </td>
                                    </tr>

                                    <div id="deleteDocument{{ $key + 1 }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <center>
                                                        <h5>Are you sure?</h5>
                                                        <p>This action can't be reversed.</p>

                                                        <a href="javascript:void(0);" class="btn btn-default" data-dismiss="modal">No</a>
                                                        <a href="{{ URL('documents/int/delete/'.\Crypt::encrypt($document->id)) }}" class="btn btn-sm btn-primary">Yes</a>
                                                    </center>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div>
                                <p>
                                    You have no documents uploaded yet.
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#uploadDocument" class="pull-right btn btn-success">Upload document</a>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="uploadDocument" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Document</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ URL('documents/int/create') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="introducerId" value="{{ $introducer->id }}">

                        <div class="form-group">
                            <label for="type">Select document type</label>
                            <select name="type" id="type" class="form-control" required="required">
                                <option disabled selected>Please select an option</option>
                                @foreach($documentTypes as $type)
                                    <option value="{{ strtolower($type) }}">{{ ucfirst($type) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="file">Select file to upload</label>
                            <input type="file" name="file" id="file" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="btn btn-default" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-sm btn-success">Upload document</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
@stop
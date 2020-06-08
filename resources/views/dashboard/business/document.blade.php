@extends('_partials.dashboard.master')
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h5 class="content-header-title">Documents</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL('/dashboard')}}">Home</a>
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
                    <h2 class="font-weight-normal font-size-22px f-2 m-0">Bank Verification Number</h2>
                    <p class="font-size-14px pt-1 pb-0 mb-0">provide your organisation BVN to allow Lenders process their loan to you.</p>
                </div>
                <div class="card-content">
                    <hr class="m-0 p-0">

                    <div class="card-body">
                        @if($bvn)
                            <form action="{{ URL('bvn/edit') }}" method="POST" onsubmit="return checkNumberLength(event);" id="bvnForm">
                        @else
                            <form action="{{ URL('bvn/create') }}" method="POST" onsubmit="return checkNumberLength(event);" id="bvnForm">
                        @endif
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <input type="hidden" name="businessId" value="{{ $business->id }}">
                                @if($bvn)
                                    <input type="hidden" name="id" value="{{ \Crypt::encrypt($bvn->id) }}">
                                @endif
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="number" name="number" id="number" class="form-control" value="{{ $bvn->number ?? null }}" onkeydown="return checkLength(event)">
                                    </div>
                                    @if(!$business->approvedAt)
                                        <div class="col-md-2">
                                            <button type="submit" id="BVNBtn" class="btn btn-block btn-success">Save changes</button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                    </div>
                </div>
                <div class="card-header">
                    <h2 class="font-weight-normal font-size-22px f-2 m-0">Documents</h2>
                    <p class="font-size-14px p-0 m-0 pt-1">Bank Statement</p>
                    <p class="font-size-14px pb-0 mb-0">6 months bank statements from your Major bank account(PDF download is acceptable).</p>
                </div>
                <div class="card-content">
                    <hr class="p-0 m-0">

                    <div class="card-body">
                        @if(count($documents) > 0)
                            @if(count($documents) < 3)
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
                                            @if(!$business->approvedAt)
                                                <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteDocument{{ $key + 1 }}"><i class="mdi mdi-delete"></i>&nbsp;Delete</a>
                                            @endif
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
                                                        <a href="{{ URL('documents/delete/'.\Crypt::encrypt($document->id)) }}" class="btn btn-sm btn-primary">Yes</a>
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
                <div class="card-header">
                    <h2 class="font-weight-normal font-size-22px f-2 m-0">Guarantors</h2>
                    <p class="font-size-14px pb-0 mb-0">Please two guarantors</p>
                </div>
                <div class="card-content">
                    <hr class="p-0 m-0">

                    <div class="card-body">
                        @if(count($guarantors) > 0)
                            @if(count($guarantors) < 2)
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#addGuarantor" class="pull-right btn btn-sm btn-success">Add a guarantor</a>
                                <br><br>
                            @endif
                            <table class="table table-striped">
                                <tbody>
                                @foreach($guarantors as $key => $guarantor)
                                    <tr>
                                        <td>{{ $guarantor->name }}</td>
                                        <td>{{ $guarantor->phone }}</td>
                                        <td>{{ $guarantor->email }}</td>
                                        <td>{{ ucfirst($guarantor->relationship) }}</td>
                                        <td>{{ $guarantor->bvn }}</td>
                                        <td>
                                            @if(!$business->approvedAt)
                                                <a href="javascript:void(0);" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#editGuarantor{{ $key + 1 }}"><i class="mdi mdi-pencil"></i>&nbsp;Edit</a>
                                                <a href="javascript:void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteGuarantor{{ $key + 1 }}"><i class="mdi mdi-delete"></i>&nbsp;Delete</a>
                                            @endif
                                        </td>
                                    </tr>

                                    <div id="deleteGuarantor{{ $key + 1 }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <center>
                                                        <h5>Are you sure?</h5>
                                                        <p>This action can't be reversed.</p>

                                                        <a href="javascript:void(0);" class="btn btn-default" data-dismiss="modal">No</a>
                                                        <a href="{{ URL('guarantors/delete/'.\Crypt::encrypt($guarantor->id)) }}" class="btn btn-sm btn-primary">Yes</a>
                                                    </center>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="editGuarantor{{ $key + 1 }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Guarantor's Profile</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <form action="{{ URL('guarantors/save') }}" method="POST">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="id" value="{{ \Crypt::encrypt($guarantor->id) }}">
                                                        <input type="hidden" name="businessId" value="{{ $business->id }}">

                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="name">Guarantor's fullname</label>
                                                                <input type="text" name="name" id="name" class="form-control" value="{{ $guarantor->name }}" required="required">
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label for="email">Guarantor's email</label>
                                                                <input type="email" name="email" id="email" class="form-control" value="{{ $guarantor->email }}" required="required">
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label for="phone">Guarantor's phone number</label>
                                                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $guarantor->phone }}" required="required">
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label for="relationship">Relationship with Guarantor</label>
                                                                <select name="relationship" id="relationship" class="form-control" required="required">
                                                                    @foreach($relationships as $relationship)
                                                                        <option value="{{ strtolower($relationship) }}" {{ strtolower($relationship) === $guarantor->relationship ? 'selected' : null }}>{{ ucfirst($relationship) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label for="bvn">Guarantor's BVN number</label>
                                                                <input type="number" name="bvn" id="editGuarantorNumber{{ $key }}" class="form-control" value="{{ $guarantor->bvn }}" onkeydown="return editGuarantorNumber(event)" required="required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="javascript:void(0);" class="btn btn-default" data-dismiss="modal">Close</a>
                                                        <button type="submit" class="btn btn-sm btn-success">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        function editGuarantorNumber(event) {
                                            field = document.getElementById('editGuarantorNumber' + '<?php echo $key; ?>')

                                            if(field.value.length < 11) {
                                                return true
                                            } else if(field.value.length == 11) {
                                                const code = parseInt(event.keyCode)
                                                if(code == 46 || code == 8) {
                                                    return true
                                                } else{
                                                    window.alert('BVN can\'t be more or less than 11 characters long');
                                                    return false
                                                }
                                            }
                                        }
                                    </script>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div>
                                <p>
                                    You have no guarantors yet.
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#addGuarantor" class="pull-right btn btn-success">Add a guarantor</a>
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

                <form action="{{ URL('documents/create') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="businessId" value="{{ $business->id }}">

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

    <div id="addGuarantor" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add a Guarantor</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ URL('guarantors/create') }}" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="businessId" value="{{ $business->id }}">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Guarantor's fullname</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required="required">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">Guarantor's email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required="required">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone">Guarantor's phone number</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required="required">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="relationship">Relationship with Guarantor</label>
                                <select name="relationship" id="relationship" class="form-control" required="required">
                                    <option disabled selected>Please select an option</option>
                                    @foreach($relationships as $relationship)
                                        <option value="{{ strtolower($relationship) }}">{{ ucfirst($relationship) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="bvn">Guarantor's BVN number</label>
                                <input type="number" name="bvn" id="guarantorNumber" class="form-control" onkeydown="return checkGuarantorNumber(event)" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="btn btn-default" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-sm btn-success">Done</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    <script>
        function checkLength(event = null) {
            const field = document.getElementById('number');
            if(field.value.length < 11) {
                return true
            } else if(field.value.length === 11) {
                const code = parseInt(event.keyCode);

                if(code === 46 || code === 8) {
                    return true
                } else{
                    window.alert('BVN can\'t be more or less than 11 characters long');
                    return false
                }
            }
        }

        function checkNumberLength(event) {
            event.preventDefault();
            let valid = false;

            const field = document.getElementById('number');
            if(field.value.length === 11) {
                valid = true;
            } else {
                valid = false;
                window.alert('BVN can\'t be more or less than 11 characters long')
            }

            if(valid) {
                document.getElementById('bvnForm').submit()
            }
        }

        function checkGuarantorNumber(event = null, key = null) {
            let field = null;

            if(key) {
                field = document.getElementById('guarantorNumber' + key)
            } else {
                field = document.getElementById('guarantorNumber')
            }

            if(field.value.length < 11) {
                return true
            } else if(field.value.length === 11) {
                const code = parseInt(event.keyCode);
                if(code === 46 || code === 8) {
                    return true
                } else{
                    window.alert('BVN can\'t be more or less than 11 characters long');
                    return false
                }
            }
        }
    </script>


@stop

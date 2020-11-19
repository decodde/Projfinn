@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Portfolios
                        </h3>
                    </div>
                    <div class="mt-2">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#openModal" class="btn btn-success">Create Portfolio <i class="la la-plus"></i></a>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    @if(count($portfolios) !== 0 )
                        <table class="table">
                            <thead class="font-weight-bolder">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Annual Return</th>
                                <th>Risk Level</th>
                                <th>Amount Per Unit</th>
                                <th>Total Units</th>
                                <th>Units Bought</th>
                            </tr>
                            </thead>
                            <tbody class="text-grey">
                            @foreach($portfolios as $portfolio)
                                <tr>
                                    <td>{{$portfolio->name}}</td>
                                    <td style="width: 30%">{{$portfolio->description}}</td>
                                    <td>{{$portfolio->returnInPer}}</td>
                                    <td>
                                        @if($portfolio->riskLevel == "low")
                                            <i class="position-relative info"  style="top: 5px;">
                                        @else
                                            <i class="position-relative yellow"  style="top: 5px;">
                                        @endif
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" fill-rule="nonzero"/>
                                                <path d="M19.5,10.5 L21,10.5 C21.8284271,10.5 22.5,11.1715729 22.5,12 C22.5,12.8284271 21.8284271,13.5 21,13.5 L19.5,13.5 C18.6715729,13.5 18,12.8284271 18,12 C18,11.1715729 18.6715729,10.5 19.5,10.5 Z M16.0606602,5.87132034 L17.1213203,4.81066017 C17.7071068,4.22487373 18.6568542,4.22487373 19.2426407,4.81066017 C19.8284271,5.39644661 19.8284271,6.34619408 19.2426407,6.93198052 L18.1819805,7.99264069 C17.5961941,8.57842712 16.6464466,8.57842712 16.0606602,7.99264069 C15.4748737,7.40685425 15.4748737,6.45710678 16.0606602,5.87132034 Z M16.0606602,18.1819805 C15.4748737,17.5961941 15.4748737,16.6464466 16.0606602,16.0606602 C16.6464466,15.4748737 17.5961941,15.4748737 18.1819805,16.0606602 L19.2426407,17.1213203 C19.8284271,17.7071068 19.8284271,18.6568542 19.2426407,19.2426407 C18.6568542,19.8284271 17.7071068,19.8284271 17.1213203,19.2426407 L16.0606602,18.1819805 Z M3,10.5 L4.5,10.5 C5.32842712,10.5 6,11.1715729 6,12 C6,12.8284271 5.32842712,13.5 4.5,13.5 L3,13.5 C2.17157288,13.5 1.5,12.8284271 1.5,12 C1.5,11.1715729 2.17157288,10.5 3,10.5 Z M12,1.5 C12.8284271,1.5 13.5,2.17157288 13.5,3 L13.5,4.5 C13.5,5.32842712 12.8284271,6 12,6 C11.1715729,6 10.5,5.32842712 10.5,4.5 L10.5,3 C10.5,2.17157288 11.1715729,1.5 12,1.5 Z M12,18 C12.8284271,18 13.5,18.6715729 13.5,19.5 L13.5,21 C13.5,21.8284271 12.8284271,22.5 12,22.5 C11.1715729,22.5 10.5,21.8284271 10.5,21 L10.5,19.5 C10.5,18.6715729 11.1715729,18 12,18 Z M4.81066017,4.81066017 C5.39644661,4.22487373 6.34619408,4.22487373 6.93198052,4.81066017 L7.99264069,5.87132034 C8.57842712,6.45710678 8.57842712,7.40685425 7.99264069,7.99264069 C7.40685425,8.57842712 6.45710678,8.57842712 5.87132034,7.99264069 L4.81066017,6.93198052 C4.22487373,6.34619408 4.22487373,5.39644661 4.81066017,4.81066017 Z M4.81066017,19.2426407 C4.22487373,18.6568542 4.22487373,17.7071068 4.81066017,17.1213203 L5.87132034,16.0606602 C6.45710678,15.4748737 7.40685425,15.4748737 7.99264069,16.0606602 C8.57842712,16.6464466 8.57842712,17.5961941 7.99264069,18.1819805 L6.93198052,19.2426407 C6.34619408,19.8284271 5.39644661,19.8284271 4.81066017,19.2426407 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            </g>
                                        </svg>
                                        </i>
                                        <span>
                                            @if($portfolio->riskLevel == "low")
                                                Low Risk
                                            @else
                                                Medium Risk
                                            @endif
                                        </span>

                                    </td>
                                    <td>
                                        <p class="font-size-17px text-success darken-4">
                                            ₦ {{App\Http\Helpers\Formatter::MoneyConvert($portfolio->amountPerUnit, "full")}}
                                        </p>
                                    </td>

                                    <td>{{$portfolio->units}}</td>
                                    <td>{{$portfolio->unitsBought}} </td>
                                    <td>
                                        <a href="{{URL('/admin/rouzz/portfolio/'.encrypt($portfolio->id))}}" class="btn btn-primary">View</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                            {{$portfolios->links()}}
                        </table>
                    @else
                        <div class="text-center dotted-btn width-550">
                            No records of any Investments yet
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="openModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{URL('admin/rouzz/portf/create')}}" class="modal-content border-0">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="modal-header border-0 p-0 pr-2 pt-1">
                    <h5 class="font-weight-bold mt-3 ml-3">Create Portfolio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <hr/>
                <div class="modal-body font-size-16 font-weight-bold py-0">
                    <div class="form-group">
                        <label for="name" class="font-size-16 font-weight-bold">Portfolio Name:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="description" class="font-size-16 font-weight-bold">Portfolio Description:</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="amountPerUnit" class="font-size-16 font-weight-bold">Amount Per Unit:</label>
                            <input type="number" name="amountPerUnit" id="amountPerUnit" class="form-control" placeholder="How much it cost for a unit, e.g 50000 = 50000 for 1 unit">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="size" class="font-size-16 font-weight-bold">Portfolio Size (Number Of Units):</label>
                            <input type="number" name="size" id="size" class="form-control" placeholder="How many units do you want in the portfolio initially e.g 200 units">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="risk" class="font-size-16 font-weight-bold">Risk Level:</label>
                            <select name="risk" id="risk" class="form-control">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <p>Interest Rates per month</p>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="three" class="font-size-16 font-weight-bold">3 months (%):</label>
                            <input type="number" name="three" id="three" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="six" class="font-size-16 font-weight-bold">6 months (%):</label>
                            <input type="number" name="six" id="six" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nine" class="font-size-16 font-weight-bold">9 months (%):</label>
                            <input type="number" name="nine" id="nine" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="twelve" class="font-size-16 font-weight-bold">12 months (%):</label>
                            <input type="number" name="twelve" id="twelve" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@stop

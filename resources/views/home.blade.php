@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card">
                <div class="card-header justify-content-between">Filter Expenses <div id="clearFilter" class="d-none btn btn-sm btn-danger float-end">Clear</div></div>
                <div class="card-body">

                    <div class="row">
                        <div class="mt-3">
                            <h6>Merchant <i class="fa-solid fa-filter"></i></h6>
                            <select class="form-select" name="merchant" id="merchantFilter">
                                <option value="all">Select merchant</option>
                                <option value="ride sharing">Ride sharing</option>
                                <option value="hotel">Hotel</option>
                                <option value="shuttle">Shuttle</option>
                                <option value="taxi">Taxi</option>
                                <option value="rental car">Rental car</option>
                                <option value="electronic">Electronic</option>
                                <option value="office supplies">Office supplies</option>
                                <option value="parking">Parking</option>
                                <option value="fast food">Fast food</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="d-flex mt-3 g-3">
                            <div class="col-6">
                                <span class="text-sm h6">Min</span>
                                <input id="min" type="number" class="form-control-sm form-control">
                            </div>

                            <div class="mx-2 col-6">
                                <span class="text-sm h6">Max</span>
                                <input id="max" type="number" class="form-control-sm form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Create Expense <i class="fa-solid fa-plus"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#importModal">
                        Import Excel
                    </button>
                </div>

                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Merchant</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Comment</th>
                              </tr>
                            </thead>
                            <tbody id="t-body">
                              
                              @if (count($expenses)>0)
                              @foreach ($expenses as $e)
                              <tr>
                                <td>{{ $e->date }}</td>
                                <td>{{ $e->merchant }}</td>
                                <td>$ {{ $e->total }}</td>
                                <td>{{ $e->status }}</td>
                                <td>{{ $e->comment }}</td>
                              </tr>
                              @endforeach
                              @else
                                  <div class="alert alert-info">You do not have any expense to display</div>
                              @endif
                              
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@include('components.modals.createExpenseModals')
@include('components.modals.importExpenseModal')
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <div class="row">
                <div class="col-md-12">
                    <form id="createExpense" action="/create" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3">
                          <h6>Merchant <span class="text-danger">*</span></h6>
                          <select class="form-select" name="merchant" id="">
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
                          @error('merchant')
                              <p class="text-sm text-dnager">{{ $message }}</p>
                          @enderror
                      </div>

                      <div>
                        <label for="formGroupExampleInput" class="form-label">Total <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id=""><b>USD</b></span>
                          <input type="number" name="total" class="form-control" placeholder="Total" value="{{ old('total') }}">
                        </div>
                        @error('total')
                              <p class="text-sm text-dnager">{{ $message }}</p>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Date <span class="text-danger">*</span></label>
                        <input name="date" type="date" class="form-control" id="formGroupExampleInput" value="{{ old('date') }}" placeholder="Example input placeholder">
                        @error('date')
                              <p class="text-sm text-dnager">{{ $message }}</p>
                          @enderror
                      </div>
                      
                      <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Comment <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="comment" id="" cols="30" rows="5">{{ old('comment') }}</textarea>
                        @error('comment')
                              <p class="text-sm text-dnager">{{ $message }}</p>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Receipt <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="receipt" id="reciept">
                        @error('receipt')
                          <p class="text-sm text-dnager">{{ $message }}</p>
                        @enderror
                      </div>

                      <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Create Expense</button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                      </div>

                    </form>
                </div>
            </div>

        </div>
      </div>
    </div>
  </div>
<!-- Modal -->
@if (session('success'))
    <div id="success"></div>
@endif

<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import Expense</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <div class="row">
                <div class="col-md-12">
                    <form id="importExpense" action="/import" method="post" enctype="multipart/form-data">
                        @csrf
                      
                        <div class="mb-2">
                            <h6>Merchant</h6>
                            <input id="import" name="importExpense" class="form-control" type="file">
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-primary">Import</button>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
      </div>
    </div>
  </div>
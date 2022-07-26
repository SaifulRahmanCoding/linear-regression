<a href="#" class="btn btn-outline-dark my-3 me-3" data-bs-toggle="modal" data-bs-target="#ImportData"> Import Data</a>

<!-- Modal -->
<div class="modal fade" id="ImportData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ImportDataLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

    <form action="action/action-training.php?opsi=impor" method="POST" enctype="multipart/form-data">

      <div class="modal-content px-3">
        <div class="modal-header">
          <h5 class="modal-title" id="ImportDataLabel">Import Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="form-group mb-1">
            <label for="file" class="mb-2">Pilih File Excel</label>

            <input name="file" id="file" accept=".xls,.xlsx" class="form-control bg-light" type="file">
          </div>

        </div>
        <div class="modal-footer justify-content-center">

          <input type="submit" name="submit" value="Import" class="btn btn-outline-dark col-12 col-lg-11 p-2">

        </div>
      </div>

    </form>

  </div>
</div>

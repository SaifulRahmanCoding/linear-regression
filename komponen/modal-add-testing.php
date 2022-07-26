<a href="#" class="btn btn-outline-dark my-3 me-3" data-bs-toggle="modal" data-bs-target="#TambahData"> Tambah Data</a>

<!-- Modal -->
<div class="modal fade" id="TambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="TambahDataLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">

    <form action="action/action-testing.php?opsi=input" method="POST">

      <div class="modal-content px-3">
        <div class="modal-header">
          <h5 class="modal-title" id="TambahDataLabel">Tambah Data Testing</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="form-group mb-1 d-flex align-items-center">
            <label for="nilai_test" class="mb-2 col-3 pt-2 pb-2">Nilai Testing</label>

            <input name="nilai_test" id="nilai_test" class="form-control bg-light" type="number">
          </div>

          <div class="form-group mb-1 d-flex align-items-center">
            <label for="parameter" class="mb-2 col-3 pt-2 pb-2">Parameter</label>

            <select id="parameter" class="form-select bg-light" name="parameter" required>
              <option value="">- Pilih</option>
              <option value="suhu">Rata-Rata Suhu Ruangan</option>
              <option value="unit">Jumlah Unit Cacat</option>
            </select>
          </div>

        </div>
        <div class="modal-footer justify-content-center">

          <input type="submit" name="submit" value="Tambah Data" class="btn btn-outline-dark col-12 col-lg-11 p-2">

        </div>
      </div>

    </form>

  </div>
</div>

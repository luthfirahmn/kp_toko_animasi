    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0"><?= $title ?></h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><?= $breadcrumb ?>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#"><?= $breadcrumb1 ?></a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"><?= $breadcrumb1 ?></h4>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" id="form-main">
                                        <input type="hidden" name="status_form" id="status_form"
                                            value="<?= $status_form ?>">
                                        <input type="hidden" name="id" id="id" value="<?= isset($id) ? $id : 0 ?>">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="first-name">Nama Product</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="nama"
                                                            placeholder="Nama Product"
                                                            value="<?= isset($all_data->nama) ? $all_data->nama : '' ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="first-name">Judul</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="judul"
                                                            placeholder="Judul"
                                                            value="<?= isset($all_data->judul) ? $all_data->judul : '' ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="first-name">Kategori</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="id_kategori">
                                                            <option
                                                                value="<?= isset($all_data->id_kategori) ? $all_data->id_kategori : '' ?>"
                                                                selected>
                                                                <?= isset($all_data->kategori) ? $all_data->kategori : 'Pilih Kategori' ?>
                                                            </option>
                                                            <?php
															foreach ($kategori as $row) {
																echo '<option value="' . $row->id . '">' . $row->kategori . '</option>';
															}
															?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="first-name">Harga</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" name="harga"
                                                            placeholder="Harga"
                                                            value="<?= isset($all_data->harga) ? $all_data->harga : '' ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="first-name">Deskripsi</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <textarea name="desc" id="desc" cols="69" rows="10"
                                                            class="form-control"><?= isset($all_data->desc) ? $all_data->desc : '' ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <form method="post">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label>Gambar</label>
                                                        </div>
                                                        <div class="custom-file col-sm-8 ml-1">
                                                            <input type="file" name="gambar" class="custom-file-input"
                                                                id="customFile" accept="image/*" />
                                                            <label class="custom-file-label" for="customFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="button" class="btn btn-primary mr-1" id="btn-save"
                                                    onclick="btn_save()">Simpan</button>
                                                <a href="<?= BACKEND_URL ?><?= $this->uri->segment(2) ?>"
                                                    class="btn btn-outline-secondary">Kembali</a>
                                            </div>


                                        </div>
                                    </form>








                                </div>

                            </div>

                        </div>
                    </div>
                </section>
                <!-- Basic Horizontal form layout section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
<form method="post" action="<?php echo e(route('profile.update')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('patch'); ?>

    <!-- PROFILE PHOTO -->
    <div class="text-center mb-4 position-relative">

        <img id="preview-image" src="<?php echo e($user->photo
    ? asset('storage/' . $user->photo)
    : asset('sbadmin/img/undraw_profile.svg')); ?>" class="rounded-circle border shadow" width="150" height="150"
            style="object-fit: cover;">

        <label for="photo-input" class="btn btn-primary rounded-circle position-absolute" style="
                bottom:10px;
                right:35%;
                width:40px;
                height:40px;
                display:flex;
                align-items:center;
                justify-content:center;
            ">
            <i class="fas fa-pencil-alt"></i>
        </label>

        <input type="file" id="photo-input" accept="image/*" hidden>
    </div>


    <!-- MODAL -->
    <div class="modal fade" id="cropModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Sesuaikan Foto Profil</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body p-0">
                    <div id="image-container">
                        <img id="crop-image">

                        <div class="dark-overlay"></div>
                        <div class="circle-hole"></div>
                        <div class="circle-frame"></div>
                    </div>
                </div>

                <div class="modal-footer">

                    <!-- zoom buttons -->
                    <div class="mr-auto">
                        <button type="button" class="btn btn-outline-secondary" id="zoom-out">
                            -
                        </button>

                        <button type="button" class="btn btn-outline-secondary" id="zoom-in">
                            +
                        </button>
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>

                    <button type="button" class="btn btn-primary" id="crop-button">
                        Gunakan
                    </button>
                </div>

            </div>
        </div>
    </div>


    <input type="hidden" name="cropped_image" id="cropped_image">


    <!-- NAME -->
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>">
    </div>


    <!-- EMAIL -->
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>">
    </div>


    <button type="submit" class="btn btn-primary">
        Simpan Perubahan
    </button>
</form>




<style>
    #image-container {
        position: relative;
        width: 100%;
        height: 450px;
        background: #000;
        overflow: hidden;
    }

    #crop-image {
        display: block;
        max-width: 100%;
    }

    /* overlay gelap */
    .dark-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        pointer-events: none;
        z-index: 15;
    }

    /* lingkaran fixed */
    .circle-frame {
        position: absolute;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        border: 3px solid white;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 40;
        pointer-events: none;
    }

    /* area tengah transparan */
    .circle-hole {
        position: absolute;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: transparent;
        z-index: 16;
        pointer-events: none;
    }

    /* cropper harus di bawah frame tapi tetap bisa diinteraksi */
    .cropper-container,
    .cropper-wrap-box,
    .cropper-canvas {
        z-index: 30 !important;
    }

    /* hide default cropper ui */
    .cropper-view-box,
    .cropper-face,
    .cropper-line,
    .cropper-point,
    .cropper-dashed {
        display: none !important;
    }
</style>

<?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/profile/partials/update-profile-information-form.blade.php ENDPATH**/ ?>
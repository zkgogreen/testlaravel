
<!-- modal profil user -->
<div class="modal fade" id="userProfile" tabindex="-1" role="dialog" aria-labelledby="Import Excel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 60%;">
        <form action="{{ route('user-update', Auth::user()->id) }}" method="post">
            @method('PUT')
            @csrf
        <div class="modal-content" style="border-radius:8px;">
            <div class="modal-header p-1">
                <h6 class="modal-title mb-1 mt-1" id="profiluser" style="margin-left: 3%;">User Profil
                </h6>
            </div>
            <div class="modal-body text-center">
                          <div class="row">
                            <div class="col mb-3">
                              <label for="name" class="form-label">Name</label>
                              <input
                                type="text"
                                id="name"
                                class="form-control"
                                placeholder="Enter Name"
                                name="name"
                                value="{{ Auth::user()->name }}"
                              />
                            </div>
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Email</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  placeholder="xxxx@xxx.xx"
                                  value="{{ Auth::user()->email }}"
                                  disabled
                                />
                              </div>
                          </div>
                          <div class="row g-2">
                            <div class="col mb-0">
                              <label for="roles" class="form-label">Roles</label>
                              <input
                                type="text"
                                id="roles"
                                class="form-control"
                                value="{{ Auth::user()->roles }}"
                                disabled
                              />
                            </div>
                            <div class="col mb-0">
                                <label for="passwordWithTitle" class="form-label">Current Password</label>
                                <input
                                  type="password"
                                  id="current_password"
                                  class="form-control"
                                  placeholder="*******"
                                  name="current_password"
                                />
                              </div>
                          </div>

                              <div class="row g-2">
                            <div class="col mb-0">
                              <label for="passwordWithTitle" class="form-label">New Password</label>
                              <input
                                type="password"
                                id="password"
                                class="form-control"
                                placeholder="*******"
                                name="password"
                              />
                            </div>
                            <div class="col mb-0">
                              <label for="confirm-password" class="form-label">Confirm New Password</label>
                              <input
                                type="password"
                                id="confirm-password"
                                class="form-control"
                                name="password_confirmation"
                                 placeholder="*******"
                              />
                            </div>
                          </div>
                          <div class="row mt-3 mx-1">
                            <span class="iconify" data-icon="carbon:warning-filled" data-width="15" data-height="15" style="margin-top: 1px;
                            margin-right: 5px;"></span> <span><small> Form Password* bisa di kosongkan jiga tidak akan mengganti password.</small></span>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                            Close
                          </button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                                                  </form>
                    </div>
                  </div>
<!-- end modal profil user -->
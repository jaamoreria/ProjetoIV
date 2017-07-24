<div class="modal fade" id="ModalEditMonitorizado" tabindex="-1" role="dialog" aria-labelledby="ModalPerfilLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="ModalPerfilLabel">Detalhes</h4>
                                </div>

                                <div class="modal-body">
                                  <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label for="recipient-nome" class="control-label">Nome:</label>
                                      <input name="nome" type="text" class="form-control" id="recipient-nome" required>
                                    </div>

                                    <div class="form-group">
                                      <label for="recipient-username" class="control-label">Username:</label>
                                      <input name="username" type="text" class="form-control" id="recipient-username" required>
                                    </div>

                                    <div class="form-group">
                                      <label for="recipient-email" class="control-label">Email:</label>
                                      <input name="email" type="email" class="form-control" id="recipient-email" required>
                                    </div>

                                    <div class="form-group">
                                      <label for="recipient-password" class="control-label">Password:</label>
                                      <input name="password" type="text" class="form-control" id="recipient-password" required>
                                    </div>

                                    <div class="form-group">
                                      <label for="recipient-telemovel" class="control-label">Telemóvel:</label>
                                      <input name="nasc" type="text" class="form-control" id="recipient-nasc" required data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                                    </div>

                                    <table>
                                      <tr>
                                        <th>
                                          <div class="form-group">
                                            <label for="exampleInputFile">Foto de perfil</label>
                                            <input type="file" id="exampleInputFile" accept="image/*" onchange="loadFile(event)" name="file">

                                          </th>
                                          <th>
                                            <img class="profile-user-img img-responsive img-circle pull-right no-border" id="output" type="hidden"/>
                                          </th>

                                          <script>
                                            var loadFile = function(event) {

                                              var output = document.getElementById('output');
                                              output.src = URL.createObjectURL(event.target.files[0]);
                                              

                                            };
                                          </script>


                                        </div>

                                      </tr>
                                    </table>


                                    <input name="id" type="hidden" class="form-control" id="id_editar">
                                    <button type="submit" name="sub_perfil" class="btn btn-success">Alterar</button>
                                    <button type="submit" name="a" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>





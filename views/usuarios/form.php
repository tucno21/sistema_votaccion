                    <!-- NOMBRE -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <spam class="input-group-text"><i class="fa fa-user"></i></spam>
                            </div>
                            <input type="text" class="form-control input-lg" name="user[name_u]" placeholder="Ingresar Nombre" value='<?php echo $user->name_u; ?>' required>
                        </div>
                    </div>
                    <!-- USUARIO -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <spam class="input-group-text"><i class="fas fa-users-cog"></i></i></spam>
                            </div>
                            <input type="text" class="form-control input-lg" name="user[username]" placeholder="Ingresar Usuario" value='<?php echo $user->username; ?>' required>
                        </div>
                    </div>
                    <!-- contraseña -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <spam class="input-group-text"><i class="fa fa-lock"></i></spam>
                            </div>
                            <input type="password" class="form-control input-lg" name="user[password]" placeholder="Ingresar Contraseña" required>
                        </div>
                    </div>
                    <!-- Perfil -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <spam class="input-group-text"><i class="fas fa-address-card"></i></spam>
                            </div>
                            <select class="form-control input-lg" name="user[profile]">
                                <?php if ($user->profile == "Administrador") : ?>
                                    <option value="Administrador">Administrador</option>
                                <?php elseif ($user->profile == "Especial") : ?>
                                    <option value="Especial">Especial</option>
                                <?php elseif ($user->profile == "Vendedor") : ?>
                                    <option value="Vendedor">Vendedor</option>
                                <?php endif; ?>
                                <option value="Administrador">Administrador</option>
                                <option value="Especial">Especial</option>
                                <option value="Vendedor">Vendedor</option>
                            </select>
                        </div>
                    </div>
                    <!-- estado -->
                    <div class="form-group">
                        <div class="border rounded input-group border-secondary">
                            <div class="input-group-prepend">
                                <spam class="input-group-text">Estado</spam>
                            </div>

                            <div class="mx-auto my-auto custom-control custom-radio">
                                <?php if ($user->estado == 1) : ?>
                                    <input value="1" type="radio" class="custom-control-input" id="estado1" name="user[estado]" checked>
                                <?php else : ?>
                                    <input value="1" type="radio" class="custom-control-input" id="estado1" name="user[estado]">
                                <?php endif; ?>
                                <label class="custom-control-label" for="estado1">Activado</label>
                            </div>
                            <div class="mx-auto my-auto custom-control custom-radio">
                                <?php if ($user->estado == 0) : ?>
                                    <input value="0" type="radio" class="custom-control-input" id="estado2" name="user[estado]" checked>
                                <?php else : ?>
                                    <input value="0" type="radio" class="custom-control-input" id="estado2" name="user[estado]">
                                <?php endif; ?>
                                <label class="custom-control-label" for="estado2">Desactivado</label>
                            </div>


                        </div>
                    </div>
                    <!-- foto -->
                    <div class="form-group">
                        <label for="imagen">Foto:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <spam class="input-group-text"><i class="fas fa-image"></i></i></spam>
                            </div>
                            <input type="file" name="user[photo]" id="imagen" class="visorFoto">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="card" style="width: 8rem;">
                            <?php if (!empty($user->photo)) : ?>
                                <img class="img-thumbnail card-img-top previsualizar" src="../imagenes/<?php echo $user->photo; ?>" alt="Card image cap">
                            <?php else : ?>
                                <img class="img-thumbnail card-img-top previsualizar" src="../adminLte/dist/img/user2-160x160.jpg" alt="Card image cap">
                            <?php endif; ?>
                            <div class="card-body">
                                <p class="card-text">Peso máximo de 1mb</p>
                            </div>
                        </div>
                    </div>
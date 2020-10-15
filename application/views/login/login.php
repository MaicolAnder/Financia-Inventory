<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Margun software, Facturación FINANCIA">
    <meta name="keywords" content="FINANCIA, Facturación, Facturación FINANCIA, Margun software, margunsoft.com, Inventario gratis, facturación en la nube">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="FINANCIA, Facturación, Facturación FINANCIA, Margun software, margunsoft.com, Inventario gratis, facturación en la nube">
    <link rel="shortcut icon" href="<?php echo img_url().'logos/pro_salud1.png'; ?>" type="image/x-icon">
    <meta name="description" content="Software gratuito en la nube para facturación e inventario, Facturación FINANCIA esta a disponibildad de pequeñas o medianas empresas gratuitamente con mínimas restricciones. Maneja tu inventario, tus clientes, proveedores, envia remisiones, notas débito y crédito, y accede a un sencillo y práctico módulo contable que te ahorrará tiempo y costo tanto para ti y tus clientes.">
      

    <title>Bienvenido a Facturación Financia</title>
    <?=css('bootstrap.min.css')?>
    <?=css('fontawesome.min.css')?>
    <?=css('bootstrap-select.min.css')?>
    <style type="text/css">
:root {
  --input-padding-x: 1.5rem;
  --input-padding-y: 0.75rem;
}

.login,
.image {
  min-height: 100vh;
}

.bg-image {
  background-image: url('<?php echo img_url().'app/mbr-1400x933.jpg'; ?>');
  background-size: cover;
  background-position: center;
}

.login-heading {
  font-weight: 300;
}

.btn-login {
  font-size: 0.9rem;
  letter-spacing: 0.05rem;
  padding: 0.75rem 1rem;
  border-radius: 2rem;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group>input,
.form-label-group>label {
  padding: var(--input-padding-y) var(--input-padding-x);
  height: auto;
  border-radius: 2rem;
}

.form-label-group>label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0;
  /* Override default `<label>` margin */
  line-height: 1.5;
  color: #495057;
  cursor: text;
  /* Match the input under the label */
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
  padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown)~label {
  padding-top: calc(var(--input-padding-y) / 3);
  padding-bottom: calc(var(--input-padding-y) / 3);
  font-size: 12px;
  color: #777;
}

/* Fallback for Edge
-------------------------------------------------- */

@supports (-ms-ime-align: auto) {
  .form-label-group>label {
    display: none;
  }
  .form-label-group input::-ms-input-placeholder {
    color: #777;
  }
}

/* Fallback for IE
-------------------------------------------------- */

@media all and (-ms-high-contrast: none),
(-ms-high-contrast: active) {
  .form-label-group>label {
    display: none;
  }
  .form-label-group input:-ms-input-placeholder {
    color: #777;
  }
}
.pt-5, .py-5 {
    padding-top: 1rem!important;
}
    </style>

</head>
<body background="">
    <div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image">
       
    </div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
              <div class="text-center" style="margin-top: 0px"  id="message">              
                  <?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: .0rem;"><strong>'.$this->session->userdata('message').'</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : ''; ?>
              </div>
            <!-- -->
            <?php if (isset($status)) { 
              if ($status == 'register') {
                echo form_open('web/register'); ?>
                <h4>REGISTRATE GRATIS</h4>
                <label>& Empieza a facturar ahora mismo </label> <br>
                <label><?php echo form_error('email') ?></label>
                <div class="form-label-group">
                    <input type="email" class="form-control" name="email" id="email" required autofocus placeholder="E-mail" value="<?php echo $email ?>">
                    <label class="label-control" for="email">Correo electrónico </label>
                </div>

                <label><?php echo form_error('user') ?></label>
                <div class="form-label-group">
                    <input type="text" class="form-control" name="user" id="user" required  placeholder="Usuario" value="<?php echo $user ?>">
                    <label class="label-control" for="user">Usuario </label>
                </div>

                <label><?php echo form_error('password') ?></label>
                <div class="form-label-group">
                    <input type="password" class="form-control"  name="password" id="password" required placeholder="Contraseña" value="<?php echo $password ?>">
                    <label class="label-control" for="password">Contraseña </label>
                </div>

                <input type="submit" name="" value="REGISTRARSE" class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2">
                
                <div class="text-center">
                    <a class="small btn btn-lg btn-dark btn-block btn-login text-uppercase font-weight-bold mb-2" href="<?php echo site_url('auth') ?>">Iniciar SESSIÓN</a>
                </div>
              <?php } elseif($status == 'person') {
                echo form_open('web/registerp'); ?>
                <h4>ALGUNOS DATOS MÁS Y LISTO</h4><br>

                <label style="display: initial; margin-bottom: .1rem;"><?php echo form_error('Nombre1_Per') ?></label>
                <div class="form-label-group">
                    <input type="text" class="form-control" name="Nombre1_Per" id="Nombre1_Per" required placeholder="<?=t('Nombre1_Per')?>" value="<?php echo $Nombre1_Per ?>">
                    <label class="label-control" for="Nombre1_Per"><?=t('Nombre1_Per')?> </label>
                </div>

                <label style="display: initial; margin-bottom: .1rem;"><?php echo form_error('Nombre2_Per') ?></label>
                <div class="form-label-group">
                    <input type="text" class="form-control" name="Nombre2_Per" id="Nombre2_Per" placeholder="<?=t('Nombre2_Per')?>" value="<?php echo $Nombre2_Per ?>">
                    <label class="label-control" for="Nombre2_Per"><?=t('Nombre2_Per')?> </label>
                </div>

                <label style="display: initial; margin-bottom: .1rem;"><?php echo form_error('Apeliido1_Per') ?></label>
                <div class="form-label-group">
                    <input type="text" class="form-control"  name="Apeliido1_Per" id="Apeliido1_Per" required placeholder="<?=t('Nombre2_Per')?>" value="<?php echo $Apeliido1_Per ?>">
                    <label class="label-control" for="Apeliido1_Per"><?=t('Apeliido1_Per')?> </label>
                </div>
                <label style="display: initial; margin-bottom: .1rem;"><?php echo form_error('Apellido2_Per') ?></label>
                <div class="form-label-group">
                    <input type="text" class="form-control"  name="Apellido2_Per" id="Apellido2_Per" placeholder="<?=t('Apellido2_Per')?>" value="<?php echo $Apellido2_Per ?>">
                    <label class="label-control" for="Apellido2_Per"><?=t('Apellido2_Per')?> </label>
                </div>
                <div class="form-label-group">
                    <input type="text" class="form-control"  name="TelCelular_Per" id="TelCelular_Per" required placeholder="<?=t('TelCelular_Per')?>" value="<?php echo $TelCelular_Per ?>">
                    <label class="label-control" for="TelCelular_Per"><?=t('TelCelular_Per')?> </label>
                </div>
                <label style="display: initial; margin-bottom: .1rem;"><?=t('Id_Mun')?> <?php echo form_error('Apellido2_Per') ?></label>
                <div class="form-label-group">
                    <select name="Id_Mun" id="Id_Mun" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_municipio as $municipio)
                        { 
                            $departamento = $this->Departamento_model->get_by_id($municipio->Id_Dep);
                            $print_value =  $municipio->Nombre_Num." (".$departamento->Nombre_Dep.")";
                            $selected = ($municipio->Id_Mun==$Id_Mun) ? 'selected':''; 
                            echo '<option value="'.$municipio->Id_Mun.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
                <input type="submit" name="finish" value="FINALIZAR" class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2">
  
              <?php } ?>

            <?php } else { ?>
              <div>
                <img src="<?php echo img_url().'logos/facturacion_Financia.png'; ?>" width="270px" alt="Facturación Financia">
              </div>
              
              <?php
                        $status_login = $this->session->userdata('status_login');
                        if (empty($status_login)) {
                            $message = "";
                            $alert = '';
                        } else {
                            $message = $status_login;
                            $alert = "danger";
                        }
                        
                        if (isset($error)) {
                        // echo $error;
                            echo '<div class="alert alert-danger alert-dismissible">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong></strong>'.$error.'
                            </div>';
                        }
                        if ($message != '') { ?>
                            <div class="alert alert-<?=$alert?> alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?php echo $message; ?>
                            </div>
                        <?php }
                    ?>
                
              <?php echo form_open('auth/cheklogin'); ?>
                <div class="form-label-group">
                    <input type="email" class="form-control" name="email" id="email" required autofocus placeholder="E-mail">
                  <label class="label-control" for="email">Usuario</label>
                </div>

                <div class="form-label-group">
                    <input type="password" class="form-control"  name="password" id="password" required placeholder="Contraseña">
                    <label class="label-control" for="password">Contraseña</label>
                </div>

                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Remember password</label>
                </div>
                <input type="submit" name="" value="Iniciar sessión" class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2">
                
                <div class="text-center">
                    <a class="small btn btn-lg btn-dark btn-block btn-login text-uppercase font-weight-bold mb-2" href="<?php echo site_url('web') ?>">REGISTRATE GRATIS!</a>
                </div>
                
              </form>
              <center><h3 class="login-heading mb-4">Bienvenido a facturación FINANCIA</h3></center>
            <?php } ?>
            </div>
          </div>
            <!-- login -->

        </div>
      </div>
    </div>
  </div>
</div>
    <?php  ?>
</body>
        <!-- -->
<?=js('jquery.min.js')?>
<?=js('popper.min.js')?>
<?=js('bootstrap.min.js')?>
<?=js('fontawesome.min.js')?>
<?=js('bootstrap-select.min.js')?>
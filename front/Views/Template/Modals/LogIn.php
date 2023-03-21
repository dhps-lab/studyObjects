<div class="modal fade" id="LogInModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formLogIn" name="formLogIn">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Usuario:</label>
                    <input type="text"
                    class="form-control" 
                    id="user" 
                    name="user" 
                    placeholder="Usuario" 
                    require="">
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Contraseña:</label>
                    <input type="password"
                    class="form-control" 
                    id="password" 
                    name="password" 
                    placeholder="Contraseña" 
                    require="">
                    <label for="message-text" id="labelRight"></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Ingresar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
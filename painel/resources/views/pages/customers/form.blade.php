<div class="modal-dialog">
    {!! Form::open(array('method' => 'POST', 'url' => api_url("ls_clientes"), 'id' => 'customersForm')) !!}
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
            {{--Return alert--}}
            <div role="alert" class="alert" id="return-alert">
                <h4>Title</h4>
                <p>Message</p>
            </div>
            {{--Form--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <h4 class="panel-title mb5">Vertical Wizard</h4>
                            <p class="mb15">A vertical style wizard that's perfect for registration or survey apps.</p>

                            <div id="wizard-vertical" class="wizard-style2">
                                <h3>Personal Details <small>Enter your personal information.</small></h3>
                                <div>
                                    <p>Try the keyboard navigation by clicking arrow left or right!</p>
                                </div>
                                <h3>Shipping Details <small>Choose your shipping options.</small></h3>
                                <div>
                                    <p>Wonderful transition effects.</p>
                                </div>
                                <h3>Payment Details <small>Enter your card information.</small></h3>
                                <div>
                                    <p>The next and previous buttons help you to navigate through your content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" id="btnSubmitModalScheduling" class="btn btn-success ladda-button" data-style="expand-left"><span class="ladda-label">Salvar alterações</span></button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
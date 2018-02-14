<script type="text/javascript">
    $(window).load(function () {
        function mensagem(msg, tipo) {
            noty({
                text: msg,
                layout: 'topRight',
                type: tipo,
                timeout: 5000
            });
        }
        @if (session('status'))
            var msg = '{{ session('status') }}';
            var tipo = '{{ session('tipo') }}';
            mensagem(msg, tipo);
        @endif
        @if (session('email'))
            var msg = '{{ session('email') }}';
            var tipo = '{{ session('tipo_envio') }}';
            mensagem(msg, tipo);
        @endif
    });        
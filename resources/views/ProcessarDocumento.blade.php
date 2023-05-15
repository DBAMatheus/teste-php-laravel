<html>
    <head>
        <title>Ler / Processar Fila</title>
    </head>
    <body>
        <h3>Ler e processar a fila de documentos</h3>
        <div>
            <button id="adicionarArquivoFila">Adicionar arquivo 2023-03-28.json na fila</button>
            <button id="processarFila">Processar Fila</button>
            <h4 id="aguarde"></h4>
        </div>
    </body>
</html>
<script
src="https://code.jquery.com/jquery-3.7.0.min.js"
integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
crossorigin="anonymous"></script>
<script>
    $(function () {
        $("#adicionarArquivoFila").click(function () {
            $.ajax('http://localhost:8000/api/adiciona-dados-arquivo-fila', {
                type: 'POST',
                beforeSend: function (xhr) {
                    $("#aguarde").html('Arquivo sendo processado, por favor aguarde...');
                    $("#adicionarArquivoFila").attr('disabled', true);
                },
                success: function (dados, status, xhr) {
                    $("#aguarde").html('');
                    alert('Dados do arquivo adicionado na fila e prontos para serem processados.');
                    $("#adicionarArquivoFila").attr('disabled', false);
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    alert('Erro ao adicionar arquivo na fila');
                }
            });
        });

        $("#processarFila").click(function () {
            $.ajax('http://localhost:8000/api/processa-fila', {
                type: 'POST',
                beforeSend: function (xhr) {
                    $("#aguarde").html('Processando a fila, por favor aguarde...');
                    $("#processarFila").attr('disabled', true);
                },
                success: function (dados, status, xhr) {
                    alert('Fila processada e dados inseridos no banco de dados');
                    $("#aguarde").html('');
                    $("#processarFila").attr('disabled', false);
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    alert('Erro ao processar a fila');
                    $("#processarFila").attr('disabled', false);
                }
            });
        });
    });
</script>
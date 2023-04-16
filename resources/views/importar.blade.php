
<!doctype html>
<html lang="pt-br" class="h-100">
  <head>
    <title>Teste PHP Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
</head>

  <body class="d-flex flex-column h-100">
    <main role="main" class="flex-shrink-0 mt-5">
        <section class="text-center">
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif
                <h1 class="jumbotron-heading">Teste PHP Laravel </h1>
                <p class="lead text-muted">Faça o upload o arquivo</p>
                <p>
                    <form action="{{ route('importar.arquivo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="exampleFormControlFile1">Faça o upload do arquivo <i>storage/data/2023-03-28.json</i> e clique no botão enviar arquivo</label>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="file">
                            <label class="custom-file-label" for="customFile">Escolha o arquivo</label>
                        </div>

                        <button type="submit" class="btn btn-primary my-2">Enviar arquivo</button>
                    </form>
                    <a href="{{ route('processar.fila') }}" class="btn btn-secondary my-2">Processar Fila ({{ $jobs }})</a>
                </p>

                <p class="lead text-muted">Documentos processados</p>
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th>Exercício</th>
                            <th>Categoria</th>
                            <th>Título</th>
                            <th>Conteúdo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documentos as $documento)
                            <tr>
                                <td>{{ $documento['exercise'] }}</td>
                                <td>{{ $documento['categories'] ? $documento['categories']['name'] : '' }}</td>
                                <td>{{ $documento['title'] }}</td>
                                <td>{{ $documento['contents'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
  </body>
  <script>
    setTimeout(function(){ $('.alert').hide(); }, 4000);

    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
  </script>
</html>

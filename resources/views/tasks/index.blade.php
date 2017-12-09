<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">

  {{-- bootstrap css CDN --}}
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  {{-- bootstrap js CDN --}}
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <title>My To Do List</title>
</head>
<body>
<div class="container">
  <div class="col-md-offset-2 col-md-8">
    <div class="row" style='margin: 3px;'>
      <h1>Todo List</h1>
    </div>

    {{-- display success message --}}
    @if (Session::has('success'))
      <div class="alert alert-success">
        <strong>Success:</strong> {{ Session::get('success') }}
      </div>
    @endif

    {{-- display error message --}}
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Error:</strong>
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="row" style='margin-top: 10px; margin-bottom: 10px;'>
      <form action="{{ route('tasks.store') }}" method='POST'>
      {{ csrf_field() }}

        <div class="col-md-9">
          <input type="text" name='newTaskName' placeholder="Nouvelle tâche" class='form-control'>
        </div>

        <div class="col-md-3">
          <input type="submit" class='btn btn-primary btn-block' value='Ajouter votre tâche'><br>
        </div>
      </form>
    </div>

    {{-- display stored tasks --}}
    @if (count($storedTasks) > 0)
      <table class="table">
        <thead>
          <th>Mes tâches</th>
          <th>A Faire</th>
          <th>Modifier</th>
          <th>Supprimer</th>
        </thead>

        <tbody>
          @foreach ($storedTasks as $storedTask)
            <tr>
              <th>{{ $storedTask->id }}</th>
              <td>{{ $storedTask->name }}</td>
              <td><a href="{{ route('tasks.edit', ['tasks'=>$storedTask->id]) }}" class='btn btn-default'>Modifier</a></td>
              <td>
                <form action="{{ route('tasks.destroy', ['tasks'=>$storedTask->id]) }}" method='POST'>
                  {{ csrf_field() }}
                  <input type="hidden" name='_method' value='DELETE'>

                  <input type="submit" class='btn btn-danger' value='Supprimer'>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif

    <div class="row text-center">
      {{ $storedTasks->links() }}
    </div>

  </div>
</div>
</body>
</html>

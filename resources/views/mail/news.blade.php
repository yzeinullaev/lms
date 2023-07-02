<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Almas Mukaman новости</title>
</head>
<body>

<h2>{{ $data['news']['name'] }}</h2>

<hr>
<div>
    {{ $data['news']['content'] }}
    <br>
    <img src="{{ $data['news']['image'] }}" alt="image">
</div>
<a href="https://education-front.mydev.kz/" tabindex="0" role="button"
   data-testid="inline-card-resolved-view" class="css-1llm9d6">Almas Mukaman</a>

</body>
</html>

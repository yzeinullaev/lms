<!DOCTYPE html>
<html lang="{{ $data['lang'] }}">
<head>
    <title>Almas Mukaman</title>
</head>
<body>

<h2>Заявка на курс {{ $data['course']['name'] }}</h2>

<hr>
<p><b>Данные от формы заявки: </b></p>
<p><b>Имя:</b> {{ $data['first_name'] }}</p>
<p><b>Фамилия:</b> {{ $data['last_name'] }}</p>
<p><b>Email:</b> {{ $data['email'] }}</p>
<p><b>Курс:</b> {{ $data['course']['name'] }}</p>
<a href="https://education-front.mydev.kz/" tabindex="0" role="button"
   data-testid="inline-card-resolved-view" class="css-1llm9d6">Almas Mukaman</a>

</body>
</html>

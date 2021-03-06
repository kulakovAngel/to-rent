@extends('layouts.app')

@section('content')
    <h1>Main Page</h1>
    <a href="{{ route('store') }}">{{ __('To store') }}</a>
    <section>
      <h2>User</h2>
      <ol>
        <li>Регистрация или вход на сайт</li>
        <li>Выбрать спортивный инвентарь для бронирования</li>
        <li>Нажать "забронировать", <b style="color: red">выбрать, на какой срок (дата начала - завтра, забрать можно сегодня)</b> (после этого количество товара на складе уменьшается)</li>
        <li>Можно отменить бронь в корзине, <b style="color: red">изменить срок</b></li>
        <li>(получаем и расплачиваемся за аренду инвентаря)</li>
        <li>После этого статус заказа "подтвержден"</li>
        <li>После истечения срока аренды заказ перемещается в архивы</li>
      </ol>
    </section>
    <section>
      <h2>Admin</h2>
      <ol>
        <li>Вход на сайт</li>
        <li>В админ-панели список необработанных заказов с датами, на которую их заказали</li>
        <li>Если заказчик взял товар, статус меняем на "подтвержден"</li>
        <li>Отображается список "должников" - кто не вернул, но должен был вернуть, а также кто должен вернуть сегодня</li>
        <li>В списке должников - кнопка "Вернул"</li>
        <li>После истечения срока аренды заказ перемещается в архивы</li>
      </ol>
    </section>
@endsection

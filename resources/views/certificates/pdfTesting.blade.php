<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
    </style>
    <link href="{{ asset('app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="wrapper uk-flex uk-flex-center uk-flex-left">
    <div class="form_overlay uk-padding uk-padding-remove-horizontal uk-padding-remove-bottom uk-width-1-1 uk-flex uk-flex-column uk-flex-middle form_test margin_top_70">
        <h2 class="text-500 uk-text-uppercase h2-header uk-align-center font-26"> Тест {{$directionName}}</h2>
        <h3 class="grey-color uk-margin-remove"> Реузльтат Вашего тестирования: {{$absUser}}</h3>
        <div class="test_block test_box margin_bottom_0">
            @foreach ($questions as $question)
                <div class="question_block">
                    <h4 class="question_header"><span>{{$loop->iteration}}.</span>  Выберите один из вариантов</h4>
                    <p class="question_desc">{{$question['text']}}</p>
                    <div class="block_with_buttons uk-flex uk-flex-middle">
                        @if ($question['answer_user']!==null)
                            <span class="answer_text">Ответ:</span>
                            @foreach(json_decode($question['answer_user']['answer'], true) as $item)
                                <div class="buttons uk-flex uk-flex-middle">
                                    <div class="input_radio">
                                        <input id="a11" type="radio" name="quest1" value="a1" checked>
                                        <label class="uk-flex uk-flex-middle uk-flex-center" for="a11"><span>{{$item}}</span></label>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

</body>
</html>
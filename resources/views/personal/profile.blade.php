@extends('personal.index')

@section('page-content')
    <div class="row justify-content-md-center">
        <div class="col-12 col-lg-8 col-lg-offset-2">
            <form action="{{ route('personal.profile') }}" class="ajax-form" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label>Обращение</label>
                    <input type="text" class="form-control" name="title" value="{{ $user->title }}" placeholder="Как к вам обращаться?" required>
                </div>
                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Ваше имя" required>
                </div>
                <div class="form-group">
                    <label>Фамилия</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Фамилия" value="{{ $user->last_name }}" required>
                </div>
                <div class="form-group">
                    <label>Отчество</label>
                    <input type="text" class="form-control" name="second_name" value="{{ $user->second_name }}" placeholder="Отчество" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" readonly value="{{ $user->email }}" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Страна</label>
                    <select class="form-control" name="country" placeholder="Выберите страну из списка" required>
                        <option value="1"  @if($user->country == 1) selected @endif >Россия</option>
                        <option value="14" @if($user->country == 14)selected @endif >Украина</option>
                        <option value="4"  @if($user->country == 4) selected @endif >Белоруссия</option>
                        <option value="6"  @if($user->country == 6) selected @endif >Казахстан</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>О себе</label>
                    <textarea name="notes" class="form-control">{{ $user->notes }}</textarea>
                </div>
                <div class="form-group">
                    <label>Дата рождения</label>
                    <div class="input-group date">
                        <input type="text" name="birthday" data-role="js-mask-birthday" class="form-control datetimepicker" data-format="date"
                               value="{{ !is_null($user->birthday) ? $user->birthday->format('d-m-Y') : '' }}"
                               placeholder="XX-XX-XXXX"
                               required
                        >
                    </div>
                </div>
                <div class="form-group text-center">
                    <label>Пол</label>
                    <div>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-secondary @if($user->gender == 1) active @endif ">
                                <input type="radio" name="gender" @if($user->gender == 1) checked @endif value="1" autocomplete="off" required>Женский</label>
                            <label class="btn btn-outline-secondary @if($user->gender == 2) active @endif ">
                                <input type="radio" name="gender" @if($user->gender == 2) checked @endif value="2" autocomplete="off" required>Мужской</label>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="checkbox simple-checkbox">
                        <input type="checkbox" name="agree" value="1" id="agree" @if( $user->agree ) checked @endif>
                        <label for="agree"><span>Согласен получать рассылку</span></label>
                    </div>
                </div>
                <div class="form-group text-center">
                    <label>Предпочитаемые версии журнала</label>
                    <div>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-secondary @if( $user->version === Cart::VERSION_PRINTED) active @endif">
                                <input type="radio" name="version" value="{{ Cart::VERSION_PRINTED }}" @if( $user->version == Cart::VERSION_PRINTED) checked @endif autocomplete="off" required>Печатный</label>
                            <label class="btn btn-outline-secondary @if( $user->version === Cart::VERSION_ELECTRONIC) active @endif">
                                <input type="radio" name="version" value="{{ Cart::VERSION_ELECTRONIC }}" @if( $user->version == Cart::VERSION_ELECTRONIC) checked @endif autocomplete="off" required>Электронный</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-buttons-holder text-center">
                    <button type="submit" class="btn btn-primary inner-form-submit" style="width:120px">
                        <span>Сохранить</span>
                    </button>
                    <button class="btn btn-light" onClick="window.location.reload()" style="width:120px">
                        <span>Отменить</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

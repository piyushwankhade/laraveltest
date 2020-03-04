@extends('layouts.app')

@section('content')
    <div class="uk-section uk-section-xsmall uk-section-muted">
        <div class="uk-container uk-container-expand">
            

            {!! Form::model($item, [
                'method' => $item->exists ? 'PUT' : 'POST',
                'route' => $item->exists ? ['article_categories.update', $item->id] : 'article_categories.store',
                'id' => 'module_form'
            ]) !!}
            <div class="uk-background-default uk-margin">
                <div class="font-size-18 mrg5B uk-padding-small">Basic Information</div>                

                @foreach (collect($errors->all())->chunk(2) as $errorItems)
                    <div class="uk-padding-small">
                        <div class="uk-flex">
                            @foreach($errorItems as $error)
                                <div class="uk-width-1-2@s uk-margin-left">
                                    <div class="uk-alert-danger" uk-alert>
                                        <a class="uk-alert-close" uk-close></a>
                                        <p>{{ $error }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="uk-grid-small uk-padding-small uk-padding-remove-top" uk-grid>
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label" title="Title" uk-tooltip="pos: top-left">
                            <span class="uk-text-middle">Title</span>
                            <i class="uk-text-middle" uk-icon="icon: question;ratio: 0.7"></i>
                        </label>

                        <div class="uk-form-controls">
                            {!! Form::text('title', null, [
                                'class' => "uk-input",
                                'placeholder' => "Title",
                                'required' => true,
                                'data-parsley-required-message' => 'Please enter title'
                            ]) !!}
                        </div>
                    </div>

                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label" title="Parent Category" uk-tooltip="pos: top-left">
                            <span class="uk-text-middle">Parent Category</span>
                            <i class="uk-text-middle" uk-icon="icon: question;ratio: 0.7"></i>
                        </label>

                        <div class="uk-form-controls">
                            {!! Form::select('category_id', $categories, null, [
                                'class' => "uk-select",
                            ]) !!}
                        </div>
                    </div>

                </div>
            </div>

          
           
            <div class="uk-background-default uk-margin-top">
                <div class="uk-padding-small" uk-grid>
                    <div class="uk-width-1-2">
                        <button class="uk-button uk-button-primary uk-button-small" type="submit">Submit</button>
                    </div>
                    <div class="uk-width-1-2 uk-text-right">
                        <a class="uk-button uk-button-default uk-button-small" href="{{ route('article_categories.index') }}">Cancel</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

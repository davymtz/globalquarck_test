<div>
    <div class="form-group">
        <label for="name_quiz">Nombre de la encuesta</label>
        <input type="text" class="form-control" wire:model.defer="quiz.name" placeholder="Ingrese el nombre de la encuesta" />
    </div>
    <div class="form-group">
        <label for="question_in_quiz">Ingrese su(s) pregunta(s): </label>
        <div class="card mb-2">
            <ul class="list-group list-group-flush">
                @foreach($quiz['questions'] as $key => $question)
                <li class="list-group-item">
                    <h6>Pregunta {{($key+1)}}</h6>
                    <div class="d-flex justify-content mb-4" wire:key="question-{{$key}}">
                        <input type="text" wire:model.defer="quiz.questions.{{$key}}.name" class="form-control" />
                        @if(count($quiz['questions']) > 1)
                        <button class="btn btn-danger" wire:click="deleteQuestion({{$key}})">Delete</button>
                        @endif
                        @error('quiz.questions.'.$key.'.name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="card">
                        <div class="card-header">Opciones <button class="btn btn-success" wire:click="addOption({{$key}})">&plus;</button></div>
                        <div class="card-body">
                            @foreach($question['options'] as $key_op => $option)
                            <div class="d-flex justify-content mb-4" wire:key="q-{{$key}}-option-{{$key_op}}">
                                <input type="text" wire:model.defer="quiz.questions.{{$key}}.options.{{$key_op}}.name" class="form-control">
                                @if(count($question['options']) > 1)
                                <button class="btn btn-danger" wire:click="deleteOption({{$key}},{{$key_op}})">Delete</button>
                                @endif
                                @error('quiz.questions.'.$key.'.options.'.$key_op.'.name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            @endforeach
                        </div>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
        <button class="btn btn-default" wire:click="addQuestion">Agregar otra pregunta &plus;</button>
    </div>
    <button wire:click="saveQuiz" onclick="confirm('¿Estás seguro de actualizar los datos?') || event.stopImmediatePropagation()" class="btn btn-success">
        <span wire:loading.remove wire:target="saveQuiz">Actualizar datos</span>
        <span wire:loading wire:target="saveQuiz">En proceso...</span>
    </button>
</div>

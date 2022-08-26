<div>
    <form wire:submit.prevent="submit">
        <div class="form-group form-group-sm mt-3">
            <label class="label" for="name">Nome completo</label>
            <input type="text" id="name" wire:model.defer="name" class="form-control form-control-sm" placeholder="Nome completo"/>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-3 mb-3">
            @forelse ($items as $index => $item)
                <div wire:key="post-items-{{ $index }}" class="mt-2 mb-2">
                    <input type="text" wire:model="items.{{ $index }}.name" class="form-control form-control-sm" placeholder="Descrição do item">
                    @error("items.$index.name")
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            @empty
                <div>Nenhum item</div>
            @endforelse
        </div>
        <button type="submit" class="btn btn-success btn-sm">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" wire:loading></span>
            <span class="visually-hidden" wire:loading>Loading...</span> Enviar
        </button>
        <button class="btn btn-primary btn-sm" wire:click="addItem" type="button">Adicionar item</button>
    </form>
</div>

<x-layouts title="Login">
    <form method="POST" class="mb-3">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary ms-5">Entrar</button>
        <a href="{{ route('Registar.create') }}" class="btn btn-secondary">Registrar</a>
    </form>
</x-layouts>

@extends('layouts.app')

@section('content')
<div class="container mt-1">
  <div class="container mt-1" style="max-width: 520px; background-color: #ffffff; padding: 35px; border-radius: 14px; box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);">
    <h3 class="mb-4">Cadastro de Cliente</h3>
    <form id="formCadastro">
    <div class="row">
      <div class="col-12 mb-3">
        <label for="nome" class="form-label">Nome completo</label>
        <input type="text" class="form-control" id="nome" name="nome" required />
      </div>

      <div class="col-12 mb-3">
        <label for="nome" class="form-label">Endereço</label>
        <input type="text" class="form-control" id="endereco" name="endereco" required />
      </div>

      <div class="row">
      <div class="col-6 mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="999.999.999-99" required />
      </div>

      <div class="mb-3 col-6">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(99) 9 9999-9999" required />
      </div>
      </div>

      <div class="mb-3 col-4">
        <label for="cnh" class="form-label">CNH</label>
        <input type="text" class="form-control" id="cnh" name="cnh" required />
      </div>

      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

    <div id="mensagem" class="mt-3"></div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/inputmask.min.js"></script>
  <script>
    const cpfInput = document.getElementById("cpf");
    Inputmask({
      mask: "999.999.999-99",
      clearIncomplete: true,
      showMaskOnFocus: true,
      placeholder: "_",
    }).mask(cpfInput);

    const cnhInput = document.getElementById("cnh");
    Inputmask({
      mask: "999-999-999-99",
      clearIncomplete: true,
      showMaskOnFocus: true,
      placeholder: "_",
    }).mask(cnhInput);

    const telefoneInput = document.getElementById("telefone");
    Inputmask({
      mask: "(99) 9 9999-9999",
      clearIncomplete: true,
      showMaskOnFocus: true,
      placeholder: "_",
    }).mask(telefoneInput);

    // Truncar CPF para 11 dígitos e formatar
    cpfInput.addEventListener("input", () => {
      let digits = cpfInput.value.replace(/\D/g, "");
      if (digits.length > 11) digits = digits.slice(0, 11);
      cpfInput.value = digits.replace(
        /(\d{3})(\d{3})(\d{3})(\d{0,2})/,
        (_, a, b, c, d) => `${a}.${b}.${c}-${d}`
      );
    });

    // Truncar CNH para 11 dígitos e formatar
    cnhInput.addEventListener("input", () => {
      let digits = cnhInput.value.replace(/\D/g, "");
      if (digits.length > 11) digits = digits.slice(0, 11);
      cnhInput.value = digits.replace(
        /(\d{3})(\d{3})(\d{3})(\d{0,2})/,
        (_, a, b, c, d) => `${a}-${b}-${c}-${d}`
      );
    });

    document.getElementById("formCadastro").addEventListener("submit", (e) => {
      e.preventDefault();

      const cpf = cpfInput.value.replace(/\D/g, "");
      const cnh = cnhInput.value.replace(/\D/g, "");
      const telefone = telefoneInput.value.replace(/\D/g, "");

      if (cpf.length !== 11) {
        mostrarMensagem("CPF deve conter exatamente 11 dígitos numéricos.", "danger");
        return;
      }

      if (cnh.length !== 11) {
        mostrarMensagem("CNH deve conter exatamente 11 dígitos numéricos.", "danger");
        return;
      }

      if (telefone.length !== 11) {
        mostrarMensagem("Telefone deve conter exatamente 11 dígitos numéricos (com DDD).", "danger");
        return;
      }

      mostrarMensagem("Cadastro realizado com sucesso!", "success");
    });

    function mostrarMensagem(texto, tipo) {
      const div = document.getElementById("mensagem");
      div.innerHTML = `<div class="alert alert-${tipo}">${texto}</div>`;
    }
  </script>
    </div>
@endsection

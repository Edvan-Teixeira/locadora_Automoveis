@extends('layouts.app')

@section('content')
<div class="container mt-3">
        <div class="row g-3">
            <div class="col-sm-8">
              <label for="Name" class="form-label">Nome Completo</label>
              <input type="text" class="form-control border border-primary" id="Name" placeholder="" value="" required>
            </div>

            <div class="col-8">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control border border-primary" id="email" placeholder="nome@email.com">
              <div class="invalid-feedback">
                Por favor, use um email válido.
              </div>
            </div>
        <div class="row g-3">

            <div class="col-sm-4">
              <label for="cpf" class="form-label">CPF</label>
              <input type="text" class="form-control border border-primary" id="cpf" placeholder="xxx.xxx.xxx-xx" required>
            </div>

            <div class="col-sm-4">
              <label for="rg" class="form-label">RG</label>
              <input type="text" class="form-control border border-primary" id="rg" placeholder="" value="" required>
            </div>
        </div>

            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Country</label>
              <select class="form-select" id="country" required>
                <option value="">Choose...</option>
                <option>United States</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
              <select class="form-select" id="state" required>
                <option value="">Choose...</option>
                <option>California</option>
              </select>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" class="form-control" id="zip" placeholder="" required>
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>
    </div>
@endsection

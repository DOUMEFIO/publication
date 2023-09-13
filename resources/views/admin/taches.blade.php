<x-app-layout>
    @section('name')
        Toutes les Tâches
    @endsection
    @section('title')
        Tâches
    @endsection
    @section('contenue')
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-body pt-0">
                    <div>
                        <div class="table-responsive table-card mb-1">
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th data-sort="customer_name"> N° Tâche</th>
                                        <th > Client</th>
                                        <th >Période </th>
                                        <th >Vues Rechercher</th>
                                        <th >Status</th>
                                        <th >Réalisation</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($taches as $tache)
                                        <tr>
                                            <td class="customer_name"><span class="badge badge-soft-primary text-uppercase">T{{$tache->nbr}}</span>
                                            </td>
                                            <td class="">{{$tache->nom}} {{$tache->prenom}}</td>
                                            <td class="">{{ \Carbon\Carbon::parse($tache->debut)->locale('fr')->isoFormat('dddd D MMMM YYYY') }} au <br>
                                                                      {{ \Carbon\Carbon::parse($tache->fin)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</td>
                                            <td class="product_name"><span class="badge badge-soft-primary text-uppercase">{{$tache->vueRecherche}}</span></td>
                                            @if ($tache->status_libelle == "Valide")
                                                <td class="status"><span class="badge badge-soft-success text-uppercase">Validée</span>
                                                </td>
                                            @else
                                                <td class="status"><span class="badge badge-soft-warning text-uppercase">Non Validée</span>
                                                </td>
                                            @endif
                                            @if ($tache->realisation ==  "Non Exécuter")
                                                <td class="status"><span class="badge badge-soft-danger text-uppercase">{{$tache->realisation}}</span>
                                                </td>
                                            @elseif ($tache->realisation ==  "Vues Non Atteint")
                                                <td class="status"><span class="badge badge-soft-warning text-uppercase">{{$tache->realisation}}</span>
                                                </td>
                                            @else
                                                <td class="status"><span class="badge badge-soft-success text-uppercase">{{$tache->realisation}}</span>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" >
                                                        <a class="dropdown-item edit-item-btn" href="{{route('showtache.client', ['id' => $tache->nbr])}}" class="btn btn-warning">
                                                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i>Voir Plus
                                                        </a>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="#">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="#">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form action="#">
                                    <div class="modal-body">
                                        <input type="hidden" id="id-field">

                                        <div class="mb-3" id="modal-id">
                                            <label for="orderId" class="form-label">ID</label>
                                            <input type="text" id="orderId" class="form-control" placeholder="ID" readonly="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="customername-field" class="form-label">Customer Name</label>
                                            <input type="text" id="customername-field" class="form-control" placeholder="Enter name" required="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="productname-field" class="form-label">Product</label>
                                            <select class="form-control" data-trigger="" name="productname-field" id="productname-field">
                                                <option value="">Product</option>
                                                <option value="Puma Tshirt">Puma Tshirt</option>
                                                <option value="Adidas Sneakers">Adidas Sneakers</option>
                                                <option value="350 ml Glass Grocery Container">350 ml Glass Grocery Container</option>
                                                <option value="American egale outfitters Shirt">American egale outfitters Shirt</option>
                                                <option value="Galaxy Watch4">Galaxy Watch4</option>
                                                <option value="Apple iPhone 12">Apple iPhone 12</option>
                                                <option value="Funky Prints T-shirt">Funky Prints T-shirt</option>
                                                <option value="USB Flash Drive Personalized with 3D Print">USB Flash Drive Personalized with 3D Print</option>
                                                <option value="Oxford Button-Down Shirt">Oxford Button-Down Shirt</option>
                                                <option value="Classic Short Sleeve Shirt">Classic Short Sleeve Shirt</option>
                                                <option value="Half Sleeve T-Shirts (Blue)">Half Sleeve T-Shirts (Blue)</option>
                                                <option value="Noise Evolve Smartwatch">Noise Evolve Smartwatch</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="date-field" class="form-label">Order Date</label>
                                            <input type="date" id="date-field" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-enable-time="" required="" placeholder="Select date">
                                        </div>

                                        <div class="row gy-4 mb-3">
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="amount-field" class="form-label">Amount</label>
                                                    <input type="text" id="amount-field" class="form-control" placeholder="Total amount" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="payment-field" class="form-label">Payment Method</label>
                                                    <select class="form-control" data-trigger="" name="payment-method" id="payment-field">
                                                        <option value="">Payment Method</option>
                                                        <option value="Mastercard">Mastercard</option>
                                                        <option value="Visa">Visa</option>
                                                        <option value="COD">COD</option>
                                                        <option value="Paypal">Paypal</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="delivered-status" class="form-label">Delivery Status</label>
                                            <select class="form-control" data-trigger="" name="delivered-status" id="delivered-status">
                                                <option value="">Delivery Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Inprogress">Inprogress</option>
                                                <option value="Cancelled">Cancelled</option>
                                                <option value="Pickups">Pickups</option>
                                                <option value="Delivered">Delivered</option>
                                                <option value="Returns">Returns</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="add-btn">Add Order</button>
                                            <button type="button" class="btn btn-success" id="edit-btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4>You are about to delete a order ?</h4>
                                        <p class="text-muted fs-15 mb-4">Deleting your order will remove all of your information from our database.</p>
                                        <div class="hstack gap-2 justify-content-center remove">
                                            <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                            <button class="btn btn-danger" id="delete-record">Yes, Delete It</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end modal -->
                </div>
            </div>

        </div>
        <!--end col-->
    </div>

    @endsection
</x-app-layout>

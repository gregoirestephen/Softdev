<div class="overlay"></div>
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info"></div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MENU PRINCIPAL</li>
                <li class="active">
                    <a href="{{route('home')}}">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>

                @can('isMedecin')
                <li>
                    <a href="{{route('patients.fiche')}}">
                        <i class="material-icons">all_inbox</i>
                        <span>Fiche Patient</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">library_books</i>
                        <span>Fiches</span>
                    </a>
                    <ul class="ml-menu">

                        <li>
                            <a href="{{route('consultations.index')}}">
                                <span>Consultations</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('medicaments.index')}}">
                                <span>Medicaments</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('rdv.liste')}}">
                                <span>Rdvs</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('ordonnances.index')}}">
                                <span>Ordonnances</span>
                            </a>
                        </li>


                    </ul>
                </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">add_box</i>
                            <span>Editions</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('traitements.index')}}">
                                    <span>Traitements</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">search</i>
                            <span>Recherches</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('historique.getsearch')}}">
                                    <span>Historique Antecedent</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('consultations.getSearch')}}">
                                    <span>Consultations</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan

                @can('isSecretaire')
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">library_books</i>
                        <span>Fiches</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('assurances.index')}}">
                                <span>Assurances</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('antecedents.index')}}">
                                <span>Antecedents</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('professions.index')}}">
                                <span>Professions</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('patients.index')}}">
                                <span>Patients</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('consultations.create')}}">
                                <span>Consultations</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('rdv.index')}}">
                                <span>Rdvs</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('actes.index')}}">
                                <span>Actes</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('medications.index')}}">
                                <span>Medications</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('dents.index')}}">
                                <span>Dents</span>
                            </a>
                        </li>

                    </ul>
                </li>
                    <li>
                        <a href="{{route('factures.consultation')}}">
                            <i class="material-icons">all_inbox</i>
                            <span>Fiche Facture</span>
                        </a>
                    </li>

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">monetization_on</i>
                        <span>Operations</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('factures.index')}}">
                                <span>Factures</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('reglements.index')}}">
                                <span>Reglements</span>
                            </a>
                        </li>
                    </ul>
                </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">search</i>
                            <span>Recherches</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('reglements.getSearch')}}">
                                    <span>Reglements</span>
                                </a>
                            </li>

                        </ul>
                </li>

                @endcan

                @can('isAdmin')
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">filter_vintage</i>
                        <span>Parametre Utlisateurs</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('profil.index')}}">
                                Profils
                            </a>
                        </li>
                        <li>
                            <a href="{{route('users.index')}}">
                                Utlisateurs
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2020 <a href="javascript:void(0);">Developed by Georges M for SoftdevSA</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->

    <!-- right Sidebar-->

    <!-- #right Sidebar-->
</section>

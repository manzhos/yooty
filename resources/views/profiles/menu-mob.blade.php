<p class="chapter chapter-profil cp-mob">Abonnements</p>
<ul>
    <li class="chapter chapter-item {{ request()->routeIs('profiles.subscription') ? 'active_item' : null }}"><a href="{{ route('profiles.subscription') }}" class="profile-menu-item">Mes demandes d’abonnements</a></li>
    <li class="chapter chapter-item {{ request()->routeIs('profiles.subscription-request') ? 'active_item' : null }}"><a href="{{ route('profiles.subscription-request') }}" class="profile-menu-item">Voir mes abonnements en cours</a></li>
</ul>

<p class="chapter chapter-profil cp-mob">Avis</p>
<ul>
    <li class="chapter chapter-item {{ request()->routeIs('profiles.notice-left') ? 'active_item' : null }}"><a href="{{ route('profiles.notice-left') }}" class="profile-menu-item">Avis laissés</a></li>
    <li class="chapter chapter-item {{ request()->routeIs('profiles.notice-receive') ? 'active_item' : null }}"><a href="{{ route('profiles.notice-receive') }}" class="profile-menu-item">Avis reçus</a></li>
</ul>

<p class="chapter chapter-profil cp-mob">Préférences de virement</p>
<ul>
    <li class="chapter chapter-item {{ request()->routeIs('profiles.payment-detail') ? 'active_item' : null }}"><a href="{{ route('profiles.payment-detail') }}" class="profile-menu-item">Ajouter/modifier mes coordonnées bancaires</a></li>
    <li class="chapter chapter-item {{ request()->routeIs('profiles.payment-history') ? 'active_item' : null }}"><a href="{{ route('profiles.payment-history') }}" class="profile-menu-item">Historique des virements</a></li>
</ul>

<p class="chapter chapter-profil cp-mob">Autres</p>
<ul>
    <li class="chapter chapter-item {{ request()->routeIs('profiles.change-pass') ? 'active_item' : null }}"><a href="{{ route('profiles.change-pass') }}" class="profile-menu-item">Modifier mon mot de passe</a></li>
    <li class="chapter chapter-item {{ request()->routeIs('profile.notification') ? 'active_item' : null }}"><a href="{{ route('profile.notification') }}" class="profile-menu-item">Notifications</a></li>
    <li class="chapter chapter-item {{ request()->routeIs('profiles.faq') ? 'active_item' : null }}"><a href="{{ route('profiles.faq') }}" class="profile-menu-item">FAQ</a></li>
    <li class="chapter chapter-item {{ request()->routeIs('profiles.privacy-policy') ? 'active_item' : null }}"><a href="{{ route('profiles.privacy-policy') }}" class="profile-menu-item">Politique de confidentialité</a></li>
</ul>

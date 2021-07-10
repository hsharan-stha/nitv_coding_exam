import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '', redirectTo: 'auth', pathMatch: 'full',
  },
  {
    path: 'auth',
    loadChildren: () => import('./auth/auth.module')
      .then((m) => m.AuthModule),
  },
  {
    path: 'featured',
    loadChildren: () => import('./featured/featured.module')
      .then((m) => m.FeaturedModule),
  },
  {
    path: '**',
    redirectTo: 'featured',
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

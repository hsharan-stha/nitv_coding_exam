import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {FeaturedComponent} from "./featured/featured.component";
import {AuthGuard} from "../guards/auth.guard";

const routes: Routes = [
  {
    path: '',
    canActivate: [AuthGuard],
    component: FeaturedComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class FeaturedRoutingModule {
}

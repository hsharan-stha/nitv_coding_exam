import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {FeaturedRoutingModule} from './featured-routing.module';
import {FeaturedComponent} from './featured/featured.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";


@NgModule({
  declarations: [FeaturedComponent],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    FeaturedRoutingModule
  ]
})
export class FeaturedModule {
}

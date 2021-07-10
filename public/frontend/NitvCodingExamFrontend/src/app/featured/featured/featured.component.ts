import {Component, OnInit} from '@angular/core';
import {FeaturedService} from "./featured.service";
import {environment} from "../../../environments/environment";
import {FormArray, FormBuilder, FormGroup, Validators} from "@angular/forms";

@Component({
  selector: 'app-featured',
  templateUrl: './featured.component.html',
  styleUrls: ['./featured.component.scss']
})
export class FeaturedComponent implements OnInit {

  public environment = environment;
  public allProfile = [];
  public profileForm: FormGroup;
  public educationQualification: FormArray;


  constructor(private service: FeaturedService, public formBuilder: FormBuilder) {
  }

  ngOnInit(): void {
    this.getAll();
    this.initializeForm();
  }

  initializeForm() {
    this.profileForm = this.formBuilder.group({
      id: [''],
      name: ['', Validators.required],
      image: ['', Validators.required],
      gender: ['', Validators.required],
      phone: ['', Validators.required],
      email: ['', Validators.required],
      nationality: ['', Validators.required],
      date_of_birth: ['', Validators.required],
      mode_of_contact: ['', Validators.required],
      qualification: this.formBuilder.array([this.createItem()]),
    });
  }

  addItem(): void {
    this.educationQualification = this.profileForm.get('qualification') as FormArray;
    this.educationQualification.push(this.createItem());
  }

  createItem(): FormGroup {
    return this.formBuilder.group({
      school_name: '',
      from_year: '',
      to_year: '',
      result: '',
    });
  }

  delete(id): void {
    this.service.delete(id).subscribe(data => {
      this.getAll();
    })
  }

  getAll(): void {
    this.service.getAll().subscribe((data) => {
      this.allProfile = data['data'];
    })
  }

  public handleFileChange(e) {

    if (
      e.target.files[0].type !== 'image/png' &&
      e.target.files[0].type !== 'image/jpg' &&
      e.target.files[0].type !== 'image/jpeg'
    ) {
      return;
    }

    this.profileForm.get('image').setValue(e.target.files[0]);


    if (e.target.files && e.target.files[0]) {
      const reader = new FileReader();
      reader.onload = (e: any) => {
      };
      reader.readAsDataURL(e.target.files[0]);
    }
  }

  onSubmit(): void {
    console.log(this.profileForm.value);

    this.service.postData(this.profileForm.value).subscribe((data) => {
      console.log(data);
    })
  }

}

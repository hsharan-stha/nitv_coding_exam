import {FormControl, FormGroup} from '@angular/forms';

declare var jQuery: any;

export class AppController {


  constructor() {
  }

  public createFormData(
    object: Object,
    form?: FormData,
    namespace?: string
  ): FormData {
    const formData = form || new FormData();
    for (let property in object) {
      if (!object.hasOwnProperty(property) || !object[property]) {
        continue;
      }
      const formKey = namespace ? `${namespace}.${property}` : property;
      if (object[property] instanceof Date) {
        formData.append(formKey, object[property].toISOString());
      } else if (
        typeof object[property] === 'object' &&
        !(object[property] instanceof File)
      ) {
        this.createFormData(object[property], formData, formKey);
      } else {
        formData.append(formKey, object[property]);
      }
    }
    return formData;
  }


  public validateAllFormFields(currentForm: FormGroup) {
    let firstInvalidElement: string = null;
    Object.keys(currentForm.controls).forEach((field) => {
      const control = currentForm.get(field);
      if (control.status == 'INVALID' && firstInvalidElement == null) {
        firstInvalidElement = field;
      }

      if (control instanceof FormControl) {
        control.markAsTouched({onlySelf: true});
      } else if (control instanceof FormGroup) {
        this.validateAllFormFields(control);
      }
    });

    if (firstInvalidElement) {
      const element: HTMLElement = document.querySelector(
        '[formControlName=\'' + firstInvalidElement + '\']'
      );
      if (element) {
        element.focus();
      }
    }
  }


  public displayInvalidFormControls(currentForm: FormGroup) {
    const invalid = [];
    const controls = currentForm.controls;
    for (const name in controls) {
      if (controls[name].status == 'INVALID') {
        invalid.push(name);
      }
    }
  }

  public checkFormControlInvalid(controlToCheck: any, form: any) {
    let field = form.get(controlToCheck);
    return field != null && field.invalid && (field.touched || field.dirty);
  }

}

<template>
  <page-content center>
    <lz-form
      :get-data="getData"
      :submit="onSubmit"
      :form.sync="form"
      :errors.sync="errors"
    >
      <lz-form-item label="所属公司" required prop="company_id">
        <a-select
          v-model="form.company_id"
          option-filter-prop="company_id"
          show-search
        >
          <a-select-option
            v-for="i of this.companies"
            :key="i.id"
            :name="i.company_name"
          >
            {{ i.company_name }}
          </a-select-option>
        </a-select>
      </lz-form-item>
      <lz-form-item label="证件类型" required prop="type_id">
        <a-select
          v-model="form.type_id"
          option-filter-prop="type_id"
          show-search
        >
          <a-select-option
            v-for="i of this.types"
            :key="i.id"
            :name="i.type_name"
          >
            {{ i.type_name }}
          </a-select-option>
        </a-select>
      </lz-form-item>
      <lz-form-item label="证件号" required prop="certificate_no">
        <a-input v-model="form.certificate_no"/>
      </lz-form-item>
      <lz-form-item label="生效日期" prop="certificate_valid_from">
        <a-input v-model="form.certificate_valid_from"/>
      </lz-form-item>
      <lz-form-item label="过期日期" prop="certificate_valid_to">
        <a-input v-model="form.certificate_valid_to"/>
      </lz-form-item>
      <lz-form-item label="证件照片" prop="certificate_images">
        <a-input v-model="form.certificate_images"/>
      </lz-form-item>
      <lz-form-item label="上次检审日期" prop="last_inspection_date">
        <a-input v-model="form.last_inspection_date"/>
      </lz-form-item>
      <lz-form-item label="下次检审日期" prop="next_inspection_date">
        <a-input v-model="form.next_inspection_date"/>
      </lz-form-item>
      <lz-form-item label="备注" prop="remark">
        <a-input v-model="form.remark"/>
      </lz-form-item>
    </lz-form>
  </page-content>
</template>

<script>
import LzForm from '@c/LzForm'
import LzFormItem from '@c/LzForm/LzFormItem'
import PageContent from '@c/PageContent'
import {
  createCertificate,
  editCertificate,
  storeCertificate,
  updateCertificate,
} from '@/api/certificate'

export default {
  name: 'Form',
  components: {
    LzForm,
    LzFormItem,
    PageContent,
  },
  data() {
    return {
      form: {
        field_name: '',
        company_id: '',
        type_id: '',
        certificate_no: '',
        certificate_valid_from: '',
        certificate_valid_to: '',
        certificate_images: '',
        last_inspection_date: '',
        next_inspection_date: '',
        status: '',
        remark: '',
      },
      errors: {},
      companies: [],
      types: [],
    }
  },
  methods: {
    async getData($form) {
      let data

      if ($form.realEditMode) {
        ({ data } = await editCertificate($form.resourceId))
      } else {
        ({ data } = await createCertificate())
      }

      this.companies = data.companies
      this.types = data.types

      return data
    },
    async onSubmit($form) {
      if ($form.realEditMode) {
        await updateCertificate($form.resourceId, this.form)
      } else {
        await storeCertificate(this.form)
      }
    },
  },
}
</script>

<template>
  <page-content center>
    <lz-form
      :get-data="getData"
      :submit="onSubmit"
      :form.sync="form"
      :errors.sync="errors"
    >
      <lz-form-item label="字段名" required prop="field_name">
        <a-input v-model="form.field_name"/>
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
} from '@/api/certificates'

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
      },
      errors: {},
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

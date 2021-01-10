<template>
  <page-content center>
    <lz-form
      :get-data="getData"
      :submit="onSubmit"
      :form.sync="form"
      :errors.sync="errors"
    >
      <lz-form-item label="类型名称" required prop="type_name">
        <a-input v-model="form.type_name"/>
      </lz-form-item>
      <lz-form-item label="简称" required prop="simple_name">
        <a-input v-model="form.simple_name"/>
      </lz-form-item>
      <lz-form-item label="是否可以更改" required prop="is_can_edit">
        <a-input v-model="form.is_can_edit"/>
      </lz-form-item>
      <lz-form-item label="备注1" required prop="remark">
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
  createType,
  editType,
  storeType,
  updateType,
} from '@/api/type'

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
        type_category: '',
        type_name: '',
        simple_name: '',
        simple_pinyin: '',
        is_can_edit: '',
        remark: '',
      },
      errors: {},
    }
  },
  methods: {
    async getData($form) {
      let data

      if ($form.realEditMode) {
        ({ data } = await editType($form.resourceId))
      } else {
        ({ data } = await createType())
      }

      return data
    },
    async onSubmit($form) {
      if ($form.realEditMode) {
        await updateType($form.resourceId, this.form)
      } else {
        await storeType(this.form)
      }
    },
  },
}
</script>

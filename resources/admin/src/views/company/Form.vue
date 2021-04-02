<template>
  <page-content center>
    <lz-form
      :get-data="getData"
      :submit="onSubmit"
      :form.sync="form"
      :errors.sync="errors"
    >
      <lz-form-item label="营业执照" required prop="certificate_id">
        <a-select
          v-model="form.certificate_id"
          option-filter-prop="certificate_id"
          show-search
          @change="licenseChanged"
        >
          <a-select-option
            v-for="i of this.licenses"
            :key="i.id"
            :name="i.company_name"
          >
            {{ i.company_name }}
          </a-select-option>
        </a-select>
      </lz-form-item>
      <lz-form-item label="公司名称" required prop="name">
        <a-input v-model="form.name" disabled="disabled"/>
      </lz-form-item>
      <lz-form-item label="来源" required prop="source">
        <a-radio-group v-model="form.source" :disabled="!hasLicense">
          <a-radio
            v-for="i of sources"
            :key="i.value"
            :value="i.value"
          >
            {{ i.label }}
          </a-radio>
        </a-radio-group>
      </lz-form-item>
      <lz-form-item label="公司相互关系" required prop="correlation">
        <a-radio-group v-model="form.correlation" :disabled="!hasLicense">
          <a-radio
            v-for="i of this.correlations"
            :key="i.value"
            :value="i.value"
          >
            {{ i.label }}
          </a-radio>
        </a-radio-group>
      </lz-form-item>
      <lz-form-item
        label="总公司"
        v-if="form.correlation!==1"
        required
        prop="parent_id"
      >
        <a-select
          v-model="form.parent_id"
          option-filter-prop="parent_id"
          show-search
          :disabled="!hasLicense"
        >
          <a-select-option
            v-for="i of this.parent_companies"
            :key="i.id"
            :name="i.name"
          >
            {{ i.name }}
          </a-select-option>
        </a-select>
      </lz-form-item>
      <lz-form-item label="简称" required prop="simple_name">
        <a-input v-model="form.simple_name" :disabled="!hasLicense"/>
      </lz-form-item>
      <lz-form-item label="经济类型" required prop="economic_id">
        <a-select
          v-model="form.economic_id"
          option-filter-prop="economic_id"
          show-search
          :disabled="!hasLicense"
        >
          <a-select-option
            v-for="i of this.categories"
            :key="i.id"
            :name="i.name"
          >
            {{ i.name }}
          </a-select-option>
        </a-select>
      </lz-form-item>
      <lz-form-item label="注册地行政区划代码" required prop="registered_area_number">
        <a-input v-model="form.registered_area_number" :disabled="!hasLicense"/>
      </lz-form-item>
      <lz-form-item label="经营详细地址" prop="actual_address">
        <a-input v-model="form.actual_address" :disabled="!hasLicense"/>
      </lz-form-item>
      <lz-form-item :label="form.correlation===3?'负责人':'法定代表人'" required prop="person">
        <a-input v-model="form.person"/>
      </lz-form-item>
      <lz-form-item label="状态" required prop="status">
        注销　<a-switch v-model="form.status" :disabled="!hasLicense"/>　正常
      </lz-form-item>
      <lz-form-item label="备注" prop="remark">
        <a-input v-model="form.remark" :disabled="!hasLicense"/>
      </lz-form-item>
    </lz-form>
  </page-content>
</template>

<script>
import LzForm from '@c/LzForm'
import LzFormItem from '@c/LzForm/LzFormItem'
import PageContent from '@c/PageContent'
import FilePicker from '@c/LzForm/FilePicker'
import {
  createCompany,
  editCompany,
  storeCompany,
  updateCompany,
} from '@/api/company'

export default {
  name: 'Form',
  components: {
    FilePicker,
    LzForm,
    LzFormItem,
    PageContent,
  },
  data() {
    return {
      form: {
        name: '',

        certificate_id: '',
        correlation: '',
        parent_id: '',
        source: '',
        simple_name: '',
        economic_id: '',

        registered_area_number: '',
        address: '',
        legal_id: '',
        incharge_id: '',

        status: '',
        remark: '',
      },
      hasLicense: false,
      errors: {},
      sources: [{ value: 1, label: '内部' }, { value: 2, label: '外部' }],
      correlations: [{ value: 1, label: '总公司' }, { value: 2, label: '子公司' }, { value: 3, label: '分公司' }],
      licenses: [],
      categories: [],
      parent_companies: [],
    }
  },
  methods: {
    async getData($form) {
      let data

      if ($form.realEditMode) {
        ({ data } = await editCompany($form.resourceId))
      } else {
        ({ data } = await createCompany())
      }

      this.form.source = this.sources[0].value
      this.form.correlation = this.correlations[0].value

      this.parent_companies = data.parent_companies
      this.categories = data.categories
      this.licenses = data.licenses
      return data
    },
    async onSubmit($form) {
      if ($form.realEditMode) {
        await updateCompany($form.resourceId, this.form)
      } else {
        await storeCompany(this.form)
      }
    },
    licenseChanged(value, item) {
      this.hasLicense = this.form.certificate_id > 0
      this.form.name = item.data.attrs.name
    },
  },
}
</script>

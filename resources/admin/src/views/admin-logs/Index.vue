<template>
  <page-content>
    <space class="my-1">
      <lz-popconfirm :title="`确认删除 ${selectedRowKeys.length} 条记录？`" :confirm="batchDestroyAdminLog">
        <a-button type="danger" :disabled="!hasSelected">删除</a-button>
      </lz-popconfirm>
      <search-form :fields="search"/>
    </space>

    <a-table
      row-key="uuid"
      :data-source="adminLogs"
      bordered
      :scroll="{ x: 600 }"
      :pagination="false"
      :row-selection="{ selectedRowKeys, onChange: onSelectChange }"
    >
      <a-table-column
        title="管理员"
        data-index="admin_user.name"
        :width="150"
        :ellipsis="true"
      />
      <a-table-column
        title="帐号"
        data-index="admin_user.username"
        :width="150"
        :ellipsis="true"
      />
      <a-table-column title="IP" data-index="ip" :width="150"/>
      <a-table-column title="方法" data-index="method" :width="80"/>
      <a-table-column
        title="URL"
        data-index="url"
        :width="500"
        :ellipsis="true"
      />
      <a-table-column title="响应码" data-index="status_code" :width="80"/>
      <a-table-column title="添加时间" data-index="created_at" :width="180"/>
      <a-table-column title="操作" :width="80">
        <template #default="record">
          <lz-popconfirm :confirm="destroyAdminLog(record.uuid)">
            <a class="error-color" href="javascript:void(0);">删除</a>
          </lz-popconfirm>
        </template>
      </a-table-column>

      <template #expandedRowRender="record">
        <a-descriptions layout="vertical">
          <a-descriptions-item label="UUID" span="3">{{ record.uuid }}</a-descriptions-item>
          <a-descriptions-item label="帐号">{{ record.admin_username }}</a-descriptions-item>
          <a-descriptions-item label="管理员(当前姓名)" span="2">{{ record.admin_name }}({{ _get(record, 'admin_user.name') }})</a-descriptions-item>
          <a-descriptions-item label="路由">{{ record.route }}</a-descriptions-item>
          <a-descriptions-item label="URL" span="2">{{ record.url }}</a-descriptions-item>
          <a-descriptions-item label="请求" span="3">
            {{ record.input }}
          </a-descriptions-item>
          <a-descriptions-item label="响应" span="3">
            {{ record.output.output }}
          </a-descriptions-item>
        </a-descriptions>
      </template>
    </a-table>
    <lz-pagination :page="page"/>
  </page-content>
</template>

<script>
import LzPagination from '@c/LzPagination'
import LzPopconfirm from '@c/LzPopconfirm'
import PageContent from '@c/PageContent'
import SearchForm from '@c/SearchForm'
import Space from '@c/Space'
import {
  batchDestroyAdminLogs,
  destroyAdminLog,
  getAdminLogs,
} from '@/api/admin-logs'
import { getMessage, removeWhile } from '@/libs/utils'
import _get from 'lodash/get'
import LoadingAction from '@c/LoadingAction'

export default {
  name: 'Index',
  scroll: true,
  components: {
    LzPopconfirm,
    PageContent,
    LzPagination,
    Space,
    SearchForm,
  },
  data() {
    return {
      search: [
        {
          field: 'uuid',
          label: 'UUID',
        },
        {
          field: 'field_name',
          label: '字段名',
        },
      ],
      adminLogs: [],
      page: null,

      selectedRowKeys: [],
    }
  },
  computed: {
    hasSelected() {
      return this.selectedRowKeys.length > 0
    },
  },
  methods: {
    destroyAdminLog(uuid) {
      return async () => {
        await destroyAdminLog(uuid)
        this.adminLogs = removeWhile(this.adminLogs, (i) => i.uuid === uuid)
        this.$message.success(getMessage('destroyed'))
      }
    },
    _get,
    onSelectChange(selectedRowKeys) {
      this.selectedRowKeys = selectedRowKeys
    },
    async batchDestroyAdminLog() {
      const uuid = this.selectedRowKeys
      await batchDestroyAdminLogs(uuid)
      this.adminLogs = removeWhile(this.adminLogs, (i) => uuid.indexOf(i.uuid) !== -1)
      this.$message.success(getMessage('destroyed'))
    },
  },
  watch: {
    $route: {
      async handler(newVal) {
        const { data: { data, meta } } = await getAdminLogs(newVal.query)
        this.adminLogs = data
        this.page = meta

        this.$scrollResolve()
      },
      immediate: true,
    },
  },
}
</script>

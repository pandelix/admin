import Request from '@/axios/request'

export function getAdminLogs(params) {
  return Request.get('admin-logs', { params })
}

export function destroyAdminLog(uuid) {
  return Request.delete(`admin-logs/${uuid}`)
}

export function batchDestroyAdminLogs(uuid) {
  return Request.post('admin-logs', {
    _method: 'DELETE',
    uuid,
  })
}

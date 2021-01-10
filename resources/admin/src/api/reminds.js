import Request from '@/axios/request'

export function getReminds(params) {
  return Request.get('reminds', { params })
}

export function createRemind() {
  return Request.get('reminds/create')
}

export function storeRemind(data) {
  return Request.post('reminds', data)
}

export function updateRemind(id, data) {
  return Request.put(`reminds/${id}`, data)
}

export function editRemind(id) {
  return Request.get(`reminds/${id}/edit`)
}

export function destroyRemind(id) {
  return Request.delete(`reminds/${id}`)
}

import Request from '@/axios/request'

export function getCertificate(params) {
  return Request.get('certificate', { params })
}

export function createCertificate() {
  return Request.get('certificate/create')
}

export function storeCertificate(data) {
  return Request.post('certificate', data)
}

export function updateCertificate(id, data) {
  return Request.put(`certificate/${id}`, data)
}

export function editCertificate(id) {
  return Request.get(`certificate/${id}/edit`)
}

export function destroyCertificate(id) {
  return Request.delete(`certificate/${id}`)
}

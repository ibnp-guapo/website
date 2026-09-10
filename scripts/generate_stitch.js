const https = require('https');

const API_KEY = process.env.STITCH_API_KEY || '';
const PROJECT_ID = process.env.STITCH_PROJECT_ID || '6725281104397729478';
const DESIGN_SYSTEM = process.env.STITCH_DESIGN_SYSTEM || 'assets/15936624324042811201';

function mcpCall(name, args, id = 1) {
  return new Promise((resolve, reject) => {
    const payload = JSON.stringify({
      jsonrpc: '2.0',
      id,
      method: 'tools/call',
      params: { name, arguments: args }
    });

    const req = https.request({
      hostname: 'stitch.googleapis.com',
      path: '/mcp',
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-Goog-Api-Key': API_KEY,
        'Content-Length': Buffer.byteLength(payload)
      },
      timeout: 120000
    }, res => {
      let data = '';
      res.on('data', chunk => data += chunk);
      res.on('end', () => {
        try {
          const parsed = JSON.parse(data);
          resolve(parsed);
        } catch (e) {
          reject(new Error('Failed to parse response: ' + data));
        }
      });
    });

    req.on('error', reject);
    req.on('timeout', () => {
      req.destroy();
      reject(new Error('Request timed out'));
    });

    req.write(payload);
    req.end();
  });
}

const prompts = [
  { name: 'Home (Página Inicial)' },
  { name: 'Programação & Calendário' },
  { name: 'Leitor Jurídico Akoma Ntoso 3.0' }
];

module.exports = { mcpCall, prompts };
